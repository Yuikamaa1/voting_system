<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\BookIssue;
use App\Models\Student;;

class BookIssuedTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase; // Resets the DB before each test

    /**
     * Test that a book can be issued correctly.
     */
    public function test_book_issue_creation()
    {
        // Create a fake student
        $student = Student::factory()->create([
            'admission_no' => '2026',
        ]);

        // Data to be sent to the endpoint
        $data = [
            'student_adm_no' => $student->admission_no,
            'book_name' => 'The Great Gatsby',
            'book_number' => '12345',
            'issue_date' => now()->format('Y-m-d'),
            'return_date' => now()->addDays(7)->format('Y-m-d'),
        ];

        // Send POST request
        $response = $this->post('/api/book-issue', $data);

        // Assert status is 201 (Created)
        $response->assertStatus(201);

        // Assert database has the record
        $this->assertDatabaseHas('book_issues', [
            'student_adm_no' => '2024001',
            'book_name' => 'The Great Gatsby',
        ]);
    }

    /**
     * Test validation error when missing fields.
     */
    public function test_book_issue_fails_validation()
    {
        // Send incomplete data
        $response = $this->post('/api/book-issue', [
            'student_adm_no' => '',
            'book_name' => '',
        ]);

        // Expect 422 Unprocessable Entity
        $response->assertStatus(422);

        // Assert that validation errors exist
        $response->assertJsonValidationErrors(['student_adm_no', 'book_name']);
    }

    /**
     * Test that an error occurs when issuing a book to a non-existent student.
     */
    public function test_error_when_student_not_found()
    {
        $response = $this->post('/api/book-issue', [
            'student_adm_no' => '999999',
            'book_name' => 'Invisible Book',
            'book_number' => '00000',
            'issue_date' => now()->format('Y-m-d'),
            'return_date' => now()->addDays(7)->format('Y-m-d'),
        ]);

        // Expect validation error
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['student_adm_no']);
    }

}
