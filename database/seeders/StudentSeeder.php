<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $departments = [
            "Computer Science", "Information Technology", "Software Engineering",
            "Data Science", "Artificial Intelligence", "Cybersecurity",
            "Electrical Engineering", "Mechanical Engineering", "Civil Engineering",
            "Chemical Engineering", "Biotechnology", "Biology", "Chemistry",
            "Physics", "Mathematics", "Economics", "Business Administration",
            "Accounting", "Finance", "Marketing", "Management", "Psychology",
            "Sociology", "Political Science", "Law", "Medicine", "Nursing",
            "Pharmacy", "Education", "Architecture"
        ];

        for ($i = 0; $i < 100; $i++) {
            // ✅ Generate Student ID in 4-1-2-3 format
            $year = $faker->numberBetween(2015, 2025);   // 4 digits
            $semester = $faker->numberBetween(1, 2);     // 1 digit
            $deptCode = str_pad($faker->numberBetween(1, 99), 2, '0', STR_PAD_LEFT); // 2 digits
            $roll = str_pad($faker->numberBetween(1, 999), 3, '0', STR_PAD_LEFT);   // 3 digits

            $studentId = "{$year}-{$semester}-{$deptCode}-{$roll}";

            Student::create([
                'student_id' => $studentId,
                'name' => $faker->name,
                'department' => $faker->randomElement($departments),
                'image' => "https://i.pravatar.cc/150?img=" . $faker->numberBetween(1, 70),
            ]);
        }
    }
}
