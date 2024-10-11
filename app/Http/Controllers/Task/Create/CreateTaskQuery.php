<?php

declare(strict_types=1);

namespace App\Http\Controllers\Task\Create;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

readonly class CreateTaskQuery
{
    public function __construct(
        private ?string  $title,
        private ?string $description = null,
        private ?string $scheduled = null
    ) {
        $this->validate();
    }

    public function validate(): void
    {
        $validator = Validator::make([
            'title' => $this->title,
            'scheduled' => $this->scheduled,
        ], [
            'title' => 'required|string|max:255',
            'scheduled' => 'nullable|date|after_or_equal:today',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getScheduled(): ?string
    {
        return $this->scheduled;
    }
}
