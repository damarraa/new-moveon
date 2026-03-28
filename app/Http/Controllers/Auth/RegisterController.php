<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    protected string $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showOperatorForm()
    {
        return view('operator.register-operator');
    }

    public function showInternalForm()
    {
        return view('auth.register-internal');
    }

    public function registerOperator(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name'   => ['required', 'string', 'max:255'],
            'owner_name'     => ['required', 'string', 'max:255'],
            'status'         => ['required', 'in:Pemilik,Pengelola'],
            'office_address' => ['required', 'string', 'max:1000'],
            'phone'          => ['required', 'string', 'max:25', 'unique:users,phone'],
            'password'       => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'company_name.required'   => 'Nama perusahaan / perorangan wajib diisi.',
            'owner_name.required'     => 'Nama pemilik / pengelola wajib diisi.',
            'status.required'         => 'Status wajib dipilih.',
            'office_address.required' => 'Alamat kantor wajib diisi.',
            'phone.required'          => 'Nomor telepon wajib diisi.',
            'phone.unique'            => 'Nomor telepon sudah terdaftar.',
            'password.required'       => 'Password wajib diisi.',
            'password.confirmed'      => 'Konfirmasi password tidak cocok.',
            'password.min'            => 'Password minimal 8 karakter.',
        ]);

        $validator->validate();

        $user = User::create([
            'name'           => $request->owner_name,
            'company_name'   => $request->company_name,
            'owner_name'     => $request->owner_name,
            'status'         => $request->status,
            'office_address' => $request->office_address,
            'phone'          => $request->phone,
            'email'          => null,
            'jabatan'        => null,
            'wilayah'        => null,
            'loket_samsat'   => null,
            'role'           => 'operator',
            'password'       => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect($this->redirectTo)->with('success', 'Pendaftaran operator berhasil.');
    }

    public function registerInternal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone'         => ['required', 'string', 'max:25', 'unique:users,phone'],
            'jabatan'       => ['required', 'string', 'max:255'],
            'wilayah'       => ['required', 'string', 'max:255'],
            'loket_samsat'  => ['required', 'string', 'max:255'],
            'role'          => ['required', 'in:internal,super_admin'],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required'         => 'Nama wajib diisi.',
            'email.required'        => 'Email wajib diisi.',
            'email.email'           => 'Format email tidak valid.',
            'email.unique'          => 'Email sudah terdaftar.',
            'phone.required'        => 'Nomor HP wajib diisi.',
            'phone.unique'          => 'Nomor HP sudah terdaftar.',
            'jabatan.required'      => 'Jabatan wajib diisi.',
            'wilayah.required'      => 'Wilayah wajib diisi.',
            'loket_samsat.required' => 'Loket Samsat wajib diisi.',
            'role.required'         => 'Role wajib dipilih.',
            'password.required'     => 'Password wajib diisi.',
            'password.confirmed'    => 'Konfirmasi password tidak cocok.',
            'password.min'          => 'Password minimal 8 karakter.',
        ]);

        $validator->validate();

        $user = User::create([
            'name'           => $request->name,
            'company_name'   => null,
            'owner_name'     => null,
            'status'         => null,
            'office_address' => null,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'jabatan'        => $request->jabatan,
            'wilayah'        => $request->wilayah,
            'loket_samsat'   => $request->loket_samsat,
            'role'           => $request->role,
            'password'       => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect($this->redirectTo)->with('success', 'Pendaftaran internal berhasil.');
    }
}