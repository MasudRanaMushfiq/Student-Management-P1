<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\AuditLog;

class StudentObserver
{
     private static $oldValues = [];

    public function updating(Student $student)
    {
        // store original values BEFORE update
        self::$oldValues = $student->getOriginal();
    }

    public function updated(Student $student)
    {
        $changes = [];

        foreach ($student->getChanges() as $field => $newValue) {

            // ignore system fields
            if (in_array($field, ['updated_at', 'created_at'])) {
                continue;
            }

            $changes[$field] = [
                'old' => $student->getOriginal($field),
                'new' => $newValue
            ];
        }

        AuditLog::create([
            'user_id'    => auth()->id(),
            'action'     => 'update',
            'model_type' => Student::class,
            'model_id'   => $student->id,
            'old_values' => $changes,
            'new_values' => $changes,
        ]);
    }
}

