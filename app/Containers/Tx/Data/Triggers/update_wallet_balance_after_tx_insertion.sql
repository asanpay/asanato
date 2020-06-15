CREATE OR REPLACE FUNCTION do_update_wallet_balance_after_tx_insertion()
    RETURNS trigger AS
$BODY$
BEGIN
    -- update wallet balance --
    UPDATE wallets
        SET balance = (balance + NEW.creditor - NEW.debtor),
            updated_at = NOW ()
        WHERE id = NEW.wallet_id;

    RETURN NEW;
END;
$BODY$
LANGUAGE plpgsql VOLATILE
COST 100;

-- trigger
DROP TRIGGER IF EXISTS update_wallet_balance_after_tx_insertion on "txes";
CREATE TRIGGER update_wallet_balance_after_tx_insertion
AFTER INSERT
    ON txes
FOR EACH ROW
EXECUTE PROCEDURE do_update_wallet_balance_after_tx_insertion()
