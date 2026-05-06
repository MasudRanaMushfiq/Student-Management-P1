<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\AuditLog;

class StudentObserver
{

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
            // FIXED STRUCTURE
            'old_values' => collect($changes)->map(fn($v) => $v['old']),
            'new_values' => collect($changes)->map(fn($v) => $v['new']),
        ]);
    }
}

