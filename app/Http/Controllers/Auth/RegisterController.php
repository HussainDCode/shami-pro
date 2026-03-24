<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['nullable', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'string', 'max:50'],
            'gender' => ['nullable', 'string', 'in:male,female,other'],
            'date_of_birth' => ['nullable', 'date'],
            'nationality' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'address' => ['nullable', 'string'],
            'account_type' => ['required', 'string', 'in:business,buyer'],
            'profile_picture' => ['nullable', 'file', 'image', 'max:5120'],
            'id_front' => ['nullable', 'file', 'image', 'max:10240'],
            'id_back' => ['nullable', 'file', 'image', 'max:10240'],
            'biz_proof' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:20480'],
            'payment_slip' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:10240'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $name = trim(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? ''));
        $uploads = $this->storeUploads(request());

        $roleSlug = $data['account_type'] === 'business'
            ? Role::SLUG_BUSINESS_OWNER
            : Role::SLUG_BUYER;
        $roleId = Role::query()->where('slug', $roleSlug)->value('id');

        return User::create([
            'role_id' => $roleId,
            'name' => $name,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'username' => $data['username'] ?? null,
            'phone' => $data['phone'] ?? null,
            'website' => $data['website'] ?? null,
            'gender' => $data['gender'] ?? null,
            'date_of_birth' => $data['date_of_birth'] ?? null,
            'nationality' => $data['nationality'] ?? null,
            'profile_picture' => $uploads['profile_picture'] ?? null,
            'country' => $data['country'] ?? null,
            'city' => $data['city'] ?? null,
            'postal_code' => $data['postal_code'] ?? null,
            'landmark' => $data['landmark'] ?? null,
            'address' => $data['address'] ?? null,
            'account_type' => $data['account_type'] ?? null,
            'id_front' => $uploads['id_front'] ?? null,
            'id_back' => $uploads['id_back'] ?? null,
            'biz_proof' => $uploads['biz_proof'] ?? null,
            'payment_slip' => $uploads['payment_slip'] ?? null,
            'payment_method' => $data['payment_method'] ?? null,
            'transaction_ref' => $data['transaction_ref'] ?? null,
        ]);
    }

    protected function storeUploads($request): array
    {
        $paths = [];
        $dir = 'users/' . date('Y/m/d');
        foreach (['profile_picture', 'id_front', 'id_back', 'biz_proof', 'payment_slip'] as $key) {
            if ($request->hasFile($key)) {
                $paths[$key] = $request->file($key)->store($dir, 'public');
            }
        }
        return $paths;
    }
}
