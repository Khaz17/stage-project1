<?php

namespace App\Rules;

use App\Http\Requests\ConducteurSaveRequest;
use Illuminate\Contracts\Validation\Rule;
use App\Models\BilanJournalier;

class Mileage implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($vid, $date)
    {
        $this->vehicule = $vid;
        $this->date_bilan = $date;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $prebj = BilanJournalier::select('kilometrage','date_bilan')
                                    ->where('vehicule_id', $this->vehicule)
                                    ->where('date_bilan','<', $this->date_bilan)
                                    ->latest('date_bilan')
                                    ->first();
        if ($prebj != null) {
            $oldmileage = $prebj->kilometrage;
            if ($value <= $oldmileage) {
                return false;
            } else {
                return true;
            }
        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Le kilométrage doit avoir une valeur supérieure à celle du kilométrage du dernier bilan";
    }
}
