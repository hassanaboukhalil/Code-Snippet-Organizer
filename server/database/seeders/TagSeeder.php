<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            "Array",
            "String",
            "Hash Table",
            "Stack",
            "Queue",
            "Heap",
            "Linked List",
            "Binary Tree",
            "Tree",
            "Graph",

            // Searching Algorithms
            "Binary Search",
            "Breadth-First Search",
            "Depth-First Search",

            // Sorting Algorithms
            "Merge Sort",
            "Quickselect",

            // Algorithm Techniques
            "Greedy",
            "Dynamic Programming",
            "Divide and Conquer",
            "Two Pointers",
            "Recursion",
        ];

        foreach ($tags as $name) {
            Tag::firstOrCreate(['name' => $name]);
        }
    }
}
