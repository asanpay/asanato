<?php

namespace App\Containers\Merchant\UI\API\Requests;

use App\Ship\Parents\Requests\Request;
use App\Ship\Rules\Domain;
use Illuminate\Validation\Rule;

/**
 * Class CreateMerchantRequest.
 */
class CreateMerchantRequest extends Request
{

    /**
     * The assigned Transporter for this Request
     *
     * @var string
     */
    protected $transporter = \App\Containers\Merchant\Data\Transporters\CreateMerchantTransporter::class;

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [
         'sharing.*.wallet',
    ];

    /**
     * Defining the URL parameters (e.g, `/user/{id}`) allows applying
     * validation rules on them and allows accessing them like request data.
     *
     * @var  array
     */
    protected $urlParameters = [
        // 'id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        $domain = $this->input('domain');
        return [
            'name'              => 'required',
            'domain'            => [
                'required',
                new Domain,
                Rule::unique('merchants')->where(function ($query) use ($domain) {
                    return $query->where('domain', $domain)
                        ->where('status', 'true');
                })],
            'ip_access'      => 'required|array|min:1',
            "ip_access.*"    => "required|ip|distinct",
            'multiplex_support' => 'required|boolean',
            'sharing'           => 'required|array|min:1',
            "sharing.*.wallet"  => "required|exists:wallets,id|distinct",
            "sharing.*.share"   => "required|numeric|max:100",
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
