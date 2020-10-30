<?php

namespace App\Traits;

use App\User;
use Illuminate\Database\QueryException;


trait CreateUserTrait{
    public function createUser($validatedData){
        $customerFullStreetName = $validatedData['customer']['street_name'] . ' ' . $validatedData['customer']['street_number'];
        $customersFullAdress[] = $customerFullStreetName . ', ' . $validatedData['customer']['city'] . ', ' .  $validatedData['customer']['zip'] . ', ' . $validatedData['customer']['county'];
        try{
            $user = User::create([
                'first_name' => $validatedData['customer']['first_name'],
                'last_name' => $validatedData['customer']['last_name'],
                'street' => $customerFullStreetName,
                'city' => $validatedData['customer']['city'],
                'county' => $validatedData['customer']['county'],
                'zip' => $validatedData['customer']['zip'],
                'email' => $validatedData['customer']['email'],
                'phone_number' => $validatedData['customer']['phone_number']
            ]);
            } catch (QueryException $e) {
                $user = User::where('email', $validatedData['customer']['email'])->firstOrFail();
                $user->update([
                    'first_name' => $validatedData['customer']['first_name'],
                    'last_name' => $validatedData['customer']['last_name'],
                    'street' => $customerFullStreetName,
                    'city' => $validatedData['customer']['city'],
                    'county' => $validatedData['customer']['county'],
                    'zip' => $validatedData['customer']['zip'],
                    'phone_number' => $validatedData['customer']['phone_number']
            ]);
                }
            return $user;
    }
}