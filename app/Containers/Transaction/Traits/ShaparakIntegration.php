<?php


namespace App\Containers\Transaction\Traits;

use App\Containers\Transaction\Enum\TransactionStatus;

trait ShaparakIntegration
{
    /**
     * return callback url for payment process
     * @return string
     */
    public function getCallbackUrl(): string
    {
        return route('web_ipg_transaction_callback', [
            'token'   => $this->token,
        ]);
    }

    /**
     * set gateway token that fetched from PSP gateway
     *
     * @param string $token
     * @param bool $save
     *
     * @return bool
     */
    public function setGatewayToken(string $token, bool $save = true): bool
    {
        $this->gateway_token = $token;
        $this->status        = TransactionStatus::GONE_TO_GATE;

        if ($save) {
            return $this->save();
        }

        return true;
    }

    /**
     * set transaction reference Id that has gotten from the PSP gateway on callback
     *
     * @param string $referenceId
     * @param bool $save
     *
     * @return bool
     */
    public function setReferenceId(string $referenceId, bool $save = true): bool
    {
        $this->gateway_ref_id = $referenceId;

        if ($save) {
            return $this->save();
        }

        return true;
    }


    /**
     * check if you transaction is ready for requesting payment token
     * @return bool
     */
    public function isReadyForTokenRequest(): bool
    {
        return intval($this->status) <= TransactionStatus::CALLBACK;
    }


    /**
     * check if transaction is ready for requesting verify transaction
     * @return bool
     */
    public function isReadyForVerify(): bool
    {
        return intval($this->status) <= TransactionStatus::VERIFIED;
    }


    /**
     * check if transaction is ready for requesting inquiry transaction (if supported by gateway)
     * @return bool
     */
    public function isReadyForInquiry(): bool
    {
        return intval($this->status) >= TransactionStatus::GONE_TO_GATE;
    }


    /**
     * check if transaction is ready for requesting settle/... transaction (if needed by gateway)
     * @return bool
     */
    public function isReadyForSettle(): bool
    {
        return intval($this->status) == TransactionStatus::VERIFIED;
    }


    /**
     * check if transaction is ready to mark as  accomplished
     * @return bool
     */
    public function isReadyForAccomplish(): bool
    {
        return (intval($this->status) >= TransactionStatus::VERIFIED) &&
            (intval($this->status) < TransactionStatus::ACCOMPLISHED);
    }


    /**
     * check if transaction is ready for accomplishment (merchant verify)
     * @return bool
     */
    public function isReadyForRefund(): bool
    {
        return
            $this->pspSupportsRefund() &&
            intval($this->status) == TransactionStatus::ACCOMPLISHED;
    }

    /**
     * update transaction by paid card number (if provided by gateway)
     *
     * @param string $cardNumber
     * @param bool $save
     *
     * @return bool
     */
    public function setCardNumber(string $cardNumber, bool $save = true): bool
    {
        $this->addToJsonb('cardNumber', $cardNumber);

        if ($save) {
            return $this->save();
        }

        return true;
    }


    /**
     * mark transaction as verified
     *
     * @param bool $save
     *
     * @return bool
     */
    public function setVerified(bool $save = true): bool
    {
        $this->status = TransactionStatus::VERIFIED;
        $this->addExtra('refund_token', uniqid('REFUND-'));

        if ($save) {
            return $this->save();
        }

        return true;
    }


    /**
     * mark transaction as settled/...
     *
     * @param bool $save
     *
     * @return bool
     */
    public function setSettled(bool $save = true): bool
    {
        $this->status = TransactionStatus::SETTLED;

        if ($save) {
            return $this->save();
        }

        return true;
    }


    /**
     * mark transaction as completed
     *
     * @param bool $save
     *
     * @return bool
     */
    public function setAccomplished(bool $save = true): bool
    {
        $this->status = TransactionStatus::ACCOMPLISHED;

        if ($save) {
            return $this->save();
        }

        return true;
    }


    /**
     * mark transaction as reversed
     *
     * @param bool $save
     *
     * @return bool
     */
    public function setRefunded(bool $save = true): bool
    {
        $this->status = TransactionStatus::REFUNDED;
        $this->addToJsonb('refund_token', strtoupper(uniqid('REF')), false);

        if ($save) {
            return $this->save();
        }

        return true;
    }


    /**
     * get transaction amount
     * @return int
     */
    public function getPayableAmount(): int
    {
        return $this->payable_amount;
    }

    /**
     * save PSP's gateway callback parameters into transaction
     *
     * @param array $parameters
     * @param bool $save
     *
     * @return bool
     */
    public function setCallBackParameters(array $parameters, bool $save = true): bool
    {
        $this->gateway_callback_params = json_encode($parameters, JSON_UNESCAPED_UNICODE);
        $this->status                  = TransactionStatus::CALLBACK;

        if ($save) {
            return $this->save();
        }

        return true;
    }


    /**
     * set transaction's extra details
     *
     * @param string $key
     * @param $value
     * @param bool $save
     *
     * @return bool
     */
    public function addExtra(string $key, $value, bool $save = false): bool
    {
        return $this->addToJsonb($key, $value, $save);
    }
}
