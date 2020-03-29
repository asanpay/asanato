<?php

namespace App\Containers\IdentityProof\Actions;

use App\Containers\IdentityProof\Enum\IdPoofType;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use Illuminate\Support\Str;

class CreateIdentityProofAction extends Action
{
    public function run(Request $request): array
    {
        $type = IdPoofType::value($request->type);

        if ($this->getUser()->isProved($type)) {
            return ['null', __('auth.proof.type_proved_before')];
        }

        $user = Apiato::call('User@FindUserByIdTask', [$request->getInputByKey('id')]);

        $idProof = Apiato::call('IdentityProof@UserGetPendingProofTask', [$user, $type]);

        if (is_null($idProof)) {
            if (empty($user->getProofValue($type))) {
                return [null, __('auth.proof.proof_data_is_empty')];
            }
            $idProof = Apiato::call('IdentityProof@CreateIdentityProofTask', [$user, $type]);
        }

        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());
        $fileName = Str::uuid();
        $idProof->addMedia($file)
            ->preservingOriginal()
            ->setFileName($fileName.'.'.$extension)
            ->toMediaCollection('user_idproof_'.$type);

        return [__('app.req_saved_succ'), null];
    }
}
