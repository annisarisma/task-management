<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $start_date = Carbon::parse('2024-01-10');
        $end_date = Carbon::parse('2024-02-10');

        $projects = [
            [
                'name' => 'Management Application',
                'description' => 'System for managing various aspects of the organization',
                'tasks' => [
                    'Create user management module',
                    'Implement role-based access control',
                    'Design and develop dashboard',
                    'Enhance user interface for better user experience',
                    'Integrate notification system',
                ],
            ],
            [
                'name' => 'Finance Tracker',
                'description' => 'Application for tracking and managing financial transactions',
                'tasks' => [
                    'Develop income tracking feature',
                    'Integrate expense management functionality',
                    'Generate financial reports',
                    'Implement budgeting system',
                    'Enhance data visualization for financial analytics',
                ],
            ],
            [
                'name' => 'E-commerce Platform',
                'description' => 'Online marketplace for buying and selling goods',
                'tasks' => [
                    'Build product catalog system',
                    'Implement shopping cart functionality',
                    'Integrate secure payment gateway',
                    'Optimize website performance for high traffic',
                    'Implement customer reviews and ratings system',
                ],
            ],
            [
                'name' => 'Project Management Tool',
                'description' => 'Collaboration platform for project planning and execution',
                'tasks' => [
                    'Develop project creation and planning features',
                    'Implement task assignment and progress tracking',
                    'Integrate document sharing and collaboration tools',
                    'Enhance communication features within the platform',
                    'Implement Gantt chart for visual project timelines',
                ],
            ],
            [
                'name' => 'Health Tracking App',
                'description' => 'App for monitoring health and fitness activities',
                'tasks' => [
                    'Develop fitness tracking features',
                    'Implement meal planning and nutrition tracking',
                    'Integrate wearable device data synchronization',
                    'Enhance user engagement with gamification elements',
                    'Implement social sharing of fitness achievements',
                ],
            ],
            [
                'name' => 'Learning Management System',
                'description' => 'Platform for managing online courses and educational content',
                'tasks' => [
                    'Develop course creation and management features',
                    'Implement user enrollment and progress tracking',
                    'Integrate video conferencing for virtual classrooms',
                    'Enhance assessment and quiz functionalities',
                    'Implement certification and achievement badges',
                ],
            ],
            [
                'name' => 'Social Media Analytics Dashboard',
                'description' => 'Tool for analyzing and visualizing social media data',
                'tasks' => [
                    'Integrate with popular social media APIs',
                    'Develop real-time analytics dashboards',
                    'Implement sentiment analysis for posts',
                    'Enhance data visualization for engagement metrics',
                    'Implement automated reporting features',
                ],
            ],
            [
                'name' => 'Inventory Management System',
                'description' => 'System for tracking and managing inventory in a retail business',
                'tasks' => [
                    'Develop product catalog and SKU management',
                    'Implement barcode scanning for inventory updates',
                    'Integrate with point-of-sale (POS) systems',
                    'Enhance order fulfillment and tracking',
                    'Implement inventory forecasting features',
                ],
            ],
            [
                'name' => 'Travel Planning App',
                'description' => 'App for planning and organizing travel itineraries',
                'tasks' => [
                    'Develop itinerary creation and editing features',
                    'Integrate with travel booking APIs',
                    'Enhance location-based recommendations',
                    'Implement expense tracking for travel budgets',
                    'Integrate with map and navigation services',
                ],
            ],
            [
                'name' => 'Task Management App',
                'description' => 'App for managing personal and team tasks',
                'tasks' => [
                    'Develop task creation and categorization features',
                    'Implement task prioritization and due dates',
                    'Enhance collaboration with shared task lists',
                    'Integrate with calendar and reminder services',
                    'Implement task completion tracking and analytics',
                ],
            ],
            [
                'name' => 'Event Planning Platform',
                'description' => 'Platform for organizing and managing events',
                'tasks' => [
                    'Develop event creation and promotion features',
                    'Implement ticketing and registration functionality',
                    'Integrate with online payment gateways',
                    'Enhance event analytics and reporting',
                    'Implement attendee engagement features',
                ],
            ],
            [
                'name' => 'Chat Application',
                'description' => 'Real-time messaging app for personal and group communication',
                'tasks' => [
                    'Develop chat interface and message delivery',
                    'Implement multimedia file sharing features',
                    'Enhance security with end-to-end encryption',
                    'Integrate voice and video calling functionality',
                    'Implement group chat management features',
                ],
            ],
            [
                'name' => 'Recipe Sharing Platform',
                'description' => 'Platform for sharing and discovering cooking recipes',
                'tasks' => [
                    'Develop recipe creation and editing features',
                    'Implement ingredient and nutrition tracking',
                    'Enhance user engagement with comments and ratings',
                    'Integrate with grocery delivery services',
                    'Implement personalized recipe recommendations',
                ],
            ],
            [
                'name' => 'Weather Forecast App',
                'description' => 'App for providing accurate and up-to-date weather forecasts',
                'tasks' => [
                    'Integrate with weather data APIs',
                    'Develop user-friendly weather visualization',
                    'Implement location-based weather alerts',
                    'Enhance user customization for weather preferences',
                    'Implement historical weather data analysis',
                ],
            ],
            [
                'name' => 'Collaborative Document Editing',
                'description' => 'Platform for real-time collaborative editing of documents',
                'tasks' => [
                    'Develop document creation and editing features',
                    'Implement real-time synchronization across users',
                    'Enhance collaboration with comments and annotations',
                    'Integrate with cloud storage services',
                    'Implement version history and rollback functionality',
                ],
            ],
            [
                'name' => 'Task Automation Dashboard',
                'description' => 'Dashboard for automating repetitive tasks and workflows',
                'tasks' => [
                    'Integrate with popular automation services',
                    'Develop customizable automation workflows',
                    'Enhance user interface for workflow visualization',
                    'Implement triggers and conditions for automation',
                    'Integrate with notification and reporting systems',
                ],
            ],
            [
                'name' => 'Language Learning App',
                'description' => 'App for learning new languages through interactive lessons',
                'tasks' => [
                    'Develop language course creation and management features',
                    'Implement interactive lessons with multimedia content',
                    'Enhance pronunciation and speech recognition features',
                    'Integrate with language proficiency assessments',
                    'Implement gamified language learning challenges',
                ],
            ],
            [
                'name' => 'Smart Home Control System',
                'description' => 'System for controlling and managing smart home devices',
                'tasks' => [
                    'Integrate with various smart home device APIs',
                    'Develop intuitive user interface for device control',
                    'Implement automation scenarios for home routines',
                    'Enhance security features for smart home systems',
                    'Integrate voice and gesture control functionalities',
                ],
            ],
            [
                'name' => 'Virtual Event Platform',
                'description' => 'Platform for hosting virtual events and conferences',
                'tasks' => [
                    'Develop virtual event creation and hosting features',
                    'Implement attendee registration and ticketing',
                    'Enhance virtual booth and exhibit hall experiences',
                    'Integrate with live streaming and video conferencing',
                    'Implement analytics for virtual event engagement',
                ],
            ],
        ];
        
        

        foreach ($projects as $project) {
            $project_data = Project::create([
                'name' => $project['name'],
                'description' => $project['description'],
                'user_id' => rand(1, 4),
                'start_date' => $start_date,
                'end_date' => $end_date,
            ]);

            $arr_member = [6, 8, 9, 10];
            $arr_member[] = $project_data->user_id;

            foreach ($arr_member as $user_id) {
                ProjectUser::create([
                    'user_id' => $user_id,
                    'project_id' => $project_data->id
                ]);
            }

            $number = 1;

            foreach ($project['tasks'] as $task) {
                Task::create([
                    'name' => $task,
                    'project_id' => $project_data->id,
                    'priority' => $number
                ]);

                $number += 1;
            }
        }
    }
}
