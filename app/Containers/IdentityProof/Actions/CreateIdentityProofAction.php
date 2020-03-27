<?php

namespace App\Containers\IdentityProof\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use Illuminate\Support\Str;

class CreateIdentityProofAction extends Action
{
    public function run(Request $request): array
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        if ($this->getUser()->isProved($request->get('type'))) {
            return ['null', __('auth.type_proved_before')];
        }

        $user = Apiato::call('User@FindUserByIdTask', [$request->getInputByKey('id')]);

        $pendingIdProof = Apiato::call('IdentityProof@UserHasPendingProofTask', [$user, $request->input('type')]);

        if ($pendingIdProof) {
            return [null, __('auth.proof.you_have_pending_idproof')];
        }

        $idProof = Apiato::call('IdentityProof@CreateIdentityProofTask', [$user, $request->input('type')]);

        $files = $request->file('files');
        foreach ($files as $file) {
            $extension = strtolower($file->getClientOriginalExtension());
            $fileName = Str::uuid();
            $idProof->addMedia($file)
                ->setFileName($fileName.'.'.$extension)
                ->toMediaCollection('user_idprooof_'.$request->get('type'));
        }

        return [__('app.req_saved_succ'), null];
    }
}
