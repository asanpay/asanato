<?php


namespace App\Containers\Authorization\UI\API\Requests;

use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Facades\Config;

class SendOtpRequest extends Request
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
        $byMobile = Config::get('authorization-container.otp.by_mobile');
        $byEmail  = Config::get('authorization-container.otp.by_email');

        return [
            'reason' => 'required|in:' . $byEmail . ',' . $byMobile,
            'mobile' => 'regex:' . config('regex.mobile_regex') . '|required_if:' . $byMobile,
            'email'  => 'email|required_if:reason,' . $byEmail,
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
