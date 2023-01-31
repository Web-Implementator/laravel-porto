<?php

declare(strict_types=1);

namespace App\Containers\User\Actions;

use App\Containers\User\Data\Repositories\UserRepository;

use App\Containers\User\Data\Transporters\GetUserDTO;
use App\Containers\User\Data\Transporters\UserLoginDTO;
use App\Ship\Parents\Actions\Action;

use Illuminate\Support\Facades\Hash;
use Auth;

final class UserLoginAction extends Action
{
    public function __construct(
        protected UserRepository $repository
    ) {
    }

    /**
     * @param UserLoginDTO $dto
     * @return array
     * @throws \Exception
     */
    public function run(UserLoginDTO $dto): array
    {
        $user = $this->repository->getBy(new GetUserDTO(email: $dto->email));
        if (empty($user)) {
            throw new \Exception('Введён не существующий Email');
        }

        if (!Hash::check($dto->password, $user->password, [])) {
            throw new \Exception('Введён не верный пароль');
        }

        Auth::attempt($dto->toArray());

        $tokenResult = $user->createToken('authToken')->plainTextToken;

        return [
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
        ];
    }
}
