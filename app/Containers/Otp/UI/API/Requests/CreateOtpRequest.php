<?php


namespace App\Containers\Otp\UI\API\Requests;

use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Facades\Config;

class CreateOtpRequest extends Request
{

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [
    ];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        $brokers = Config::get('otp-container.brokers');

        $all     = [];
        foreach ($brokers as $broker => $reasons) {
            $all[] = $reasons;
        }

        return [
            'reason' => 'required|in:' . implode(',', $all),
            'mobile' => 'regex:' . config('regex.mobile_regex') . '|required_if:reason,' . $brokers['mobile'],
            'email'  => 'email|required_if:reason,' . $brokers['email'],
        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
