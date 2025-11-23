<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PlayerProfile;
use App\Models\Organization;
use App\Models\PlayerOrganizationRequest;
use App\Models\CricketMatch;
use App\Models\Score;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Organizations
        $org1User = User::create([
            'name' => 'Colombo Cricket Club',
            'email' => 'colombo@cricket.lk',
            'password' => Hash::make('password'),
            'role' => 'organization',
            'status' => 'active',
        ]);

        $org1 = Organization::create([
            'user_id' => $org1User->id,
            'name' => 'Colombo Cricket Club',
            'district' => 'Colombo',
            'description' => 'Premier cricket club in Colombo, established 1832. We focus on developing young talent and competing at the highest level.',
        ]);

        $org2User = User::create([
            'name' => 'Kandy Warriors',
            'email' => 'kandy@cricket.lk',
            'password' => Hash::make('password'),
            'role' => 'organization',
            'status' => 'active',
        ]);

        $org2 = Organization::create([
            'user_id' => $org2User->id,
            'name' => 'Kandy Warriors',
            'district' => 'Kandy',
            'description' => 'Dynamic cricket team from the hill capital. Known for aggressive batting and fast bowling.',
        ]);

        $org3User = User::create([
            'name' => 'Galle Gladiators',
            'email' => 'galle@cricket.lk',
            'password' => Hash::make('password'),
            'role' => 'organization',
            'status' => 'active',
        ]);

        $org3 = Organization::create([
            'user_id' => $org3User->id,
            'name' => 'Galle Gladiators',
            'district' => 'Galle',
            'description' => 'Coastal cricket powerhouse. Specializing in spin bowling and tactical gameplay.',
        ]);

        $org4User = User::create([
            'name' => 'Jaffna Stallions',
            'email' => 'jaffna@cricket.lk',
            'password' => Hash::make('password'),
            'role' => 'organization',
            'status' => 'active',
        ]);

        $org4 = Organization::create([
            'user_id' => $org4User->id,
            'name' => 'Jaffna Stallions',
            'district' => 'Jaffna',
            'description' => 'Northern pride of Sri Lankan cricket. Champions of the 2020 season.',
        ]);

        // Create Players
        $players = [
            [
                'name' => 'Kasun Perera',
                'email' => 'kasun@player.lk',
                'age' => 24,
                'district' => 'Colombo',
                'batting_style' => 'Right-hand bat',
                'bowling_style' => 'Right-arm fast',
                'bio' => 'Aggressive opening batsman with a knack for quick runs. Played U19 nationals.',
            ],
            [
                'name' => 'Dinesh Silva',
                'email' => 'dinesh@player.lk',
                'age' => 22,
                'district' => 'Kandy',
                'batting_style' => 'Left-hand bat',
                'bowling_style' => 'Left-arm orthodox',
                'bio' => 'All-rounder with excellent spin bowling skills. Represented district team.',
            ],
            [
                'name' => 'Nuwan Fernando',
                'email' => 'nuwan@player.lk',
                'age' => 26,
                'district' => 'Galle',
                'batting_style' => 'Right-hand bat',
                'bowling_style' => 'Right-arm medium',
                'bio' => 'Experienced middle-order batsman. Known for finishing matches under pressure.',
            ],
            [
                'name' => 'Chamara Wickramasinghe',
                'email' => 'chamara@player.lk',
                'age' => 21,
                'district' => 'Colombo',
                'batting_style' => 'Right-hand bat',
                'bowling_style' => 'Right-arm fast-medium',
                'bio' => 'Young fast bowler with raw pace. Training at national academy.',
            ],
            [
                'name' => 'Tharindu Jayawardena',
                'email' => 'tharindu@player.lk',
                'age' => 25,
                'district' => 'Jaffna',
                'batting_style' => 'Right-hand bat',
                'bowling_style' => 'Leg-break googly',
                'bio' => 'Talented leg-spinner. Took 5 wickets in district finals.',
            ],
            [
                'name' => 'Lahiru Mendis',
                'email' => 'lahiru@player.lk',
                'age' => 23,
                'district' => 'Kandy',
                'batting_style' => 'Left-hand bat',
                'bowling_style' => null,
                'bio' => 'Wicket-keeper batsman. Quick reflexes behind the stumps.',
            ],
        ];

        $playerProfiles = [];
        foreach ($players as $playerData) {
            $user = User::create([
                'name' => $playerData['name'],
                'email' => $playerData['email'],
                'password' => Hash::make('password'),
                'role' => 'player',
                'status' => 'active',
            ]);

            $playerProfiles[] = PlayerProfile::create([
                'user_id' => $user->id,
                'name' => $playerData['name'],
                'age' => $playerData['age'],
                'district' => $playerData['district'],
                'batting_style' => $playerData['batting_style'],
                'bowling_style' => $playerData['bowling_style'],
                'bio' => $playerData['bio'],
            ]);
        }

        // Create Player-Organization Requests
        // Approved requests
        PlayerOrganizationRequest::create([
            'player_id' => $playerProfiles[0]->id,
            'organization_id' => $org1->id,
            'status' => 'approved',
        ]);

        PlayerOrganizationRequest::create([
            'player_id' => $playerProfiles[1]->id,
            'organization_id' => $org2->id,
            'status' => 'approved',
        ]);

        PlayerOrganizationRequest::create([
            'player_id' => $playerProfiles[2]->id,
            'organization_id' => $org3->id,
            'status' => 'approved',
        ]);

        // Pending requests
        PlayerOrganizationRequest::create([
            'player_id' => $playerProfiles[3]->id,
            'organization_id' => $org1->id,
            'status' => 'pending',
        ]);

        PlayerOrganizationRequest::create([
            'player_id' => $playerProfiles[4]->id,
            'organization_id' => $org2->id,
            'status' => 'pending',
        ]);

        // Create Matches
        // Live Match
        $liveMatch = CricketMatch::create([
            'team_a_id' => $org1->id,
            'team_b_id' => $org2->id,
            'venue' => 'R. Premadasa Stadium, Colombo',
            'match_date' => Carbon::now()->subHours(1),
            'overs' => 20,
            'status' => 'live',
        ]);

        Score::create([
            'match_id' => $liveMatch->id,
            'team_batting' => 'Colombo Cricket Club',
            'runs' => 142,
            'wickets' => 4,
            'overs_completed' => 15.3,
            'striker_name' => 'Kasun Perera',
            'non_striker_name' => 'Ashan Silva',
            'bowler_name' => 'Dinesh Silva',
            'last_ball_comment' => 'SIX! Massive hit over long-on! Perera is on fire!',
        ]);

        // Another Live Match
        $liveMatch2 = CricketMatch::create([
            'team_a_id' => $org3->id,
            'team_b_id' => $org4->id,
            'venue' => 'Galle International Stadium',
            'match_date' => Carbon::now()->subMinutes(30),
            'overs' => 20,
            'status' => 'live',
        ]);

        Score::create([
            'match_id' => $liveMatch2->id,
            'team_batting' => 'Galle Gladiators',
            'runs' => 87,
            'wickets' => 2,
            'overs_completed' => 10.2,
            'striker_name' => 'Nuwan Fernando',
            'non_striker_name' => 'Chaminda Perera',
            'bowler_name' => 'Tharindu Jayawardena',
            'last_ball_comment' => 'FOUR! Beautiful cover drive through the gap!',
        ]);

        // Upcoming Matches
        CricketMatch::create([
            'team_a_id' => $org1->id,
            'team_b_id' => $org3->id,
            'venue' => 'Pallekele International Cricket Stadium',
            'match_date' => Carbon::now()->addDays(2)->setTime(14, 30),
            'overs' => 50,
            'status' => 'upcoming',
        ]);

        CricketMatch::create([
            'team_a_id' => $org2->id,
            'team_b_id' => $org4->id,
            'venue' => 'Mahinda Rajapaksa International Cricket Stadium',
            'match_date' => Carbon::now()->addDays(3)->setTime(10, 0),
            'overs' => 20,
            'status' => 'upcoming',
        ]);

        CricketMatch::create([
            'team_a_id' => $org1->id,
            'team_b_id' => $org4->id,
            'venue' => 'Sinhalese Sports Club Ground, Colombo',
            'match_date' => Carbon::now()->addDays(5)->setTime(15, 0),
            'overs' => 20,
            'status' => 'upcoming',
        ]);

        CricketMatch::create([
            'team_a_id' => $org3->id,
            'team_b_id' => $org2->id,
            'venue' => 'Asgiriya Stadium, Kandy',
            'match_date' => Carbon::now()->addWeek()->setTime(14, 0),
            'overs' => 50,
            'status' => 'upcoming',
        ]);

        // Finished Match
        $finishedMatch = CricketMatch::create([
            'team_a_id' => $org1->id,
            'team_b_id' => $org3->id,
            'venue' => 'R. Premadasa Stadium, Colombo',
            'match_date' => Carbon::now()->subDays(2),
            'overs' => 20,
            'status' => 'finished',
        ]);

        Score::create([
            'match_id' => $finishedMatch->id,
            'team_batting' => 'Colombo Cricket Club',
            'runs' => 178,
            'wickets' => 6,
            'overs_completed' => 20.0,
            'striker_name' => 'Kasun Perera',
            'non_striker_name' => 'Ashan Silva',
            'bowler_name' => 'Nuwan Fernando',
            'last_ball_comment' => 'Match finished! Colombo Cricket Club wins by 23 runs!',
        ]);

        $this->command->info('Demo data seeded successfully!');
        $this->command->info('');
        $this->command->info('=== Demo Accounts ===');
        $this->command->info('Admin: admin@findeleven.com / password');
        $this->command->info('');
        $this->command->info('Organizations:');
        $this->command->info('  - colombo@cricket.lk / password (Colombo Cricket Club)');
        $this->command->info('  - kandy@cricket.lk / password (Kandy Warriors)');
        $this->command->info('  - galle@cricket.lk / password (Galle Gladiators)');
        $this->command->info('  - jaffna@cricket.lk / password (Jaffna Stallions)');
        $this->command->info('');
        $this->command->info('Players:');
        $this->command->info('  - kasun@player.lk / password (Kasun Perera - Colombo CC)');
        $this->command->info('  - dinesh@player.lk / password (Dinesh Silva - Kandy Warriors)');
        $this->command->info('  - nuwan@player.lk / password (Nuwan Fernando - Galle Gladiators)');
        $this->command->info('  - chamara@player.lk / password (Chamara - Pending at Colombo CC)');
        $this->command->info('  - tharindu@player.lk / password (Tharindu - Pending at Kandy)');
        $this->command->info('  - lahiru@player.lk / password (Lahiru Mendis - No organization)');
        $this->command->info('');
        $this->command->info('Matches: 2 Live, 4 Upcoming, 1 Finished');
    }
}
