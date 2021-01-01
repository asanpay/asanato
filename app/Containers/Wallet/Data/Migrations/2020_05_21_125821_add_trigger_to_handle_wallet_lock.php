<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

// @codingStandardsIgnoreLine
class AddTriggerToHandleWalletLock extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        $query = <<<EOD
CREATE OR REPLACE FUNCTION check_wallet_lock_status()
  RETURNS trigger AS
$$

BEGIN
 -- only check wallets that does not belong to app --
IF OLD.belongs_to_app = false AND NEW.balance < 0 THEN
       RAISE EXCEPTION 'wallet % balance could not be less than zero.', OLD.id;
END IF;

IF OLD.belongs_to_app = false AND OLD.locked = true AND (NEW.balance <= OLD.balance) THEN
       RAISE EXCEPTION 'wallet % is locked.', OLD.id;
END IF;

IF OLD.belongs_to_app = false AND OLD.locked = false AND (NEW.balance < OLD.locked_balance) THEN
       RAISE EXCEPTION 'wallet % balance become less than locked balance.', OLD.id;
END IF;

RETURN NEW;

END;

$$
LANGUAGE 'plpgsql';

DROP TRIGGER IF EXISTS check_wallet_lock_status_trigger ON wallets;

CREATE TRIGGER check_wallet_lock_status_trigger
BEFORE UPDATE OF balance
ON wallets
FOR EACH ROW EXECUTE PROCEDURE check_wallet_lock_status();
EOD;
        \Illuminate\Support\Facades\DB::connection()->getPdo()->exec($query);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $query = <<<EOD
DROP TRIGGER IF EXISTS check_wallet_lock_status_trigger
  ON wallets;
DROP FUNCTION IF EXISTS check_wallet_lock_status;
EOD;
        \Illuminate\Support\Facades\DB::connection()->getPdo()->exec($query);
    }
}
