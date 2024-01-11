<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $message = Message::create([
            'from_id' => 2,
            'to_id' => 1,
            'is_seen' => true,
            'body' => 'Hola, como estas?',
            'created_at' => now()->sub('1 hour'),
        ]);

        $message = Message::create([
            'from_id' => 1,
            'to_id' => 2,
            'body' => 'Estoy bien e tu como estas',
            'created_at' => now()->sub('25 minutes'),
        ]);

        $message = Message::create([
            'from_id' => 2,
            'to_id' => 1,
            'is_seen' => true,
            'body' => 'Estoy bien',
            'created_at' => now()->sub('24 minutes'),
        ]);

        $message = Message::create([
            'from_id' => 1,
            'to_id' => 2,
            'body' => 'Let\'s talk in English shall we?',
            'created_at' => now()->sub('23 minutes'),
        ]);

        $message = Message::create([
            'from_id' => 2,
            'to_id' => 1,
            'body' => 'Alright let\'s go!',
            'created_at' => now()->sub('22 minutes'),
        ]);

        $message = Message::create([
            'from_id' => 1,
            'to_id' => 2,
            'body' => 'Have you ever thought about how much Artificial Intelligence is shaping our lives?',
            'created_at' => now()->sub('21 minutes'),
        ]);

        $message = Message::create([
            'from_id' => 2,
            'to_id' => 1,
            'body' => 'Oh, definitely! AI is everywhere nowadays, from voice assistants to recommendation algorithms. It\'s pretty fascinating.',
            'created_at' => now()->sub('19 minutes'),
        ]);

        $message = Message::create([
            'from_id' => 1,
            'to_id' => 2,
            'body' => 'Right? I was reading about machine learning, and it\'s crazy how computers can learn from data and improve their performance over time 😊',
            'created_at' => now()->sub('18 minutes'),
        ]);

        $message = Message::create([
            'from_id' => 2,
            'to_id' => 1,
            'body' => 'It\'s like they\'re getting smarter on their own. Did you know AI is also used in healthcare for diagnostics and treatment planning?',
            'created_at' => now()->sub('17 minutes'),
        ]);

        $message = Message::create([
            'from_id' => 1,
            'to_id' => 2,
            'body' => 'Yeah, I\'ve heard about that! It\'s amazing how technology is advancing to improve medical outcomes. But, some people worry about AI taking over jobs. What do you think? 🤗',
            'created_at' => now()->sub('16 minutes'),
        ]);

        $message = Message::create([
            'from_id' => 2,
            'to_id' => 1,
            'body' => 'It\'s a valid concern. Automation might replace some jobs, but it can also create new opportunities. We just need to adapt and maybe focus on skills that AI can\'t replicate easily.',
            'created_at' => now()->sub('14 minutes'),
        ]);

        $message = Message::create([
            'from_id' => 3,
            'to_id' => 1,
            'body' => 'Hi super como estas?',
            'created_at' => now()->sub('14 minutes'),
        ]);

        // Other user
        $message = Message::create([
            'from_id' => 1,
            'to_id' => 4,
            'body' => 'Hello how are you?',
            'created_at' => now()->sub('14 minutes'),
        ]);

        // Other user
        $message = Message::create([
            'from_id' => 1,
            'to_id' => 5,
            'body' => 'Hi regular user',
            'created_at' => now()->sub('14 minutes'),
        ]);

        // Other user
        $message = Message::create([
            'from_id' => 6,
            'to_id' => 1,
            'body' => 'Hi super how are you?',
            'created_at' => now()->sub('14 minutes'),
        ]);

        // Other user
        $message = Message::create([
            'from_id' => 1,
            'to_id' => 7,
            'body' => 'What can I help you with?',
            'created_at' => now()->sub('14 minutes'),
        ]);
    }
}
