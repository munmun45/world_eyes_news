<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admins / Users
        $admin = User::updateOrCreate(
            ['email' => 'admin@worldeyesnews.com'],
            [
                'name' => 'Editorial Chief',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'avatar' => null,
            ]
        );

        $editor = User::updateOrCreate(
            ['email' => 'editor@worldeyesnews.com'],
            [
                'name' => 'Senior Foreign Correspondent',
                'password' => Hash::make('editor123'),
                'role' => 'editor',
                'avatar' => null,
            ]
        );

        // 2. Settings
        $settings = [
            'site_name' => 'World Eyes News',
            'tagline' => 'Global Insight, Uncompromised Truth',
            'contact_email' => 'contact@worldeyesnews.com',
            'contact_phone' => '+1 (800) 555-0199',
            'address' => 'World News Media Tower, 5th Avenue, New York, NY',
            'about_text' => 'World Eyes News is an independent international news organisation delivering real-time breaking news, investigative reporting, deep analysis, and multimedia stories spanning geopolitics, technology, business, culture, and sports across the globe.',
            'footer_copyright' => '© ' . date('Y') . ' World Eyes News. All rights reserved.',
            'breaking_enabled' => '1',
            'social_facebook' => 'https://facebook.com',
            'social_twitter' => 'https://twitter.com',
            'social_instagram' => 'https://instagram.com',
            'social_youtube' => 'https://youtube.com',
            'social_linkedin' => 'https://linkedin.com',
        ];

        foreach ($settings as $k => $v) {
            Setting::set($k, $v);
        }

        // 3. Categories
        $categoriesData = [
            [
                'name' => 'World News',
                'slug' => 'world-news',
                'description' => 'Geopolitics, diplomatic developments, conflicts and international summits from across the globe.',
                'color' => '#0d6efd',
                'order' => 1,
            ],
            [
                'name' => 'Entertainment',
                'slug' => 'entertainment',
                'description' => 'Cinema, streaming releases, award circuits, celebrity interviews, and pop culture trends.',
                'color' => '#d63384',
                'order' => 2,
            ],
            [
                'name' => 'Technology & AI',
                'slug' => 'technology',
                'description' => 'Frontier artificial intelligence, cybersecurity, consumer hardware, and silicon breakthroughs.',
                'color' => '#0dcaf0',
                'order' => 3,
            ],
            [
                'name' => 'Business & Markets',
                'slug' => 'business',
                'description' => 'Global markets, macroeconomic policy, energy trade, tech startups, and central banking.',
                'color' => '#6610f2',
                'order' => 4,
            ],
            [
                'name' => 'Sports Arena',
                'slug' => 'sports',
                'description' => 'Football, cricket, Formula 1, tennis, Olympics, and international tournaments.',
                'color' => '#198754',
                'order' => 5,
            ],
            [
                'name' => 'Science & Climate',
                'slug' => 'science-climate',
                'description' => 'Space exploration, renewable energy transition, ecological studies, and medical research.',
                'color' => '#20c997',
                'order' => 6,
            ],
            [
                'name' => 'Opinion & Analysis',
                'slug' => 'opinion',
                'description' => 'Thought-provoking commentary, editorial perspectives, and deep geopolitical essays.',
                'color' => '#fd7e14',
                'order' => 7,
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $cData) {
            $categories[$cData['slug']] = Category::updateOrCreate(['slug' => $cData['slug']], $cData);
        }

        // 4. Articles Data
        $articles = [
            [
                'title' => 'Global Climate Summit Reaches Historic Agreement on Renewable Energy Infrastructure Financing',
                'category_slug' => 'world-news',
                'summary' => 'Delegates from 195 nations have ratified a comprehensive multilateral framework allocating $400 billion to accelerate clean grid transitions in developing nations.',
                'content' => '<p>In what diplomatic observers are calling a watershed moment for environmental governance, over 190 nations concluded protracted negotiations in Geneva today with a binding agreement on global clean energy transitions.</p>
                <h3>Historic Capital Commitments</h3>
                <p>The landmark pact establishes a dedicated financing vehicle capitalized at $400 billion over the next decade. Major sovereign wealth funds, development banks, and multilateral institutions have pledged direct matching allocations to bolster electrical grid resilience across the Global South.</p>
                <blockquote>"This is not merely an aspirational accord; it contains verified reporting mechanisms and milestone-based disbursements," declared the summit chief negotiator.</blockquote>
                <p>Special priority will be granted to cross-border high-voltage direct current (HVDC) transmission corridors, battery storage fabrication plants, and green hydrogen hubs.</p>
                <h3>Immediate Implementation Roadmap</h3>
                <p>Starting in the third quarter of this year, technical assistance task forces will deploy to regional economic commissions to formulate country-specific tender frameworks, mitigating bureaucratic friction and reducing project gestation periods.</p>',
                'image' => 'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=1200&auto=format&fit=crop&q=80',
                'image_caption' => 'Delegates at the plenary session applauding the adoption of the final resolution in Geneva.',
                'is_breaking' => true,
                'is_featured' => true,
                'is_trending' => true,
                'views_count' => 14200,
                'tags' => 'Climate, United Nations, Renewable Energy, Economics',
            ],
            [
                'title' => 'Korean Cinema Renaissance: How Modern Seoul Filmmakers Are Redefining Global Narrative Cinema',
                'category_slug' => 'entertainment',
                'summary' => 'From Cannes triumphs to dominant streaming numbers worldwide, South Korean creators continue pioneering nuanced character studies blended with high-concept thrillers.',
                'content' => '<p>Over the past decade, South Korean cinema has evolved from an art-house favorite into an undeniable titan of global entertainment culture. Following the historic awards sweep of <em>Parasite</em> and the viral sensation of international streaming hits, the industry is experiencing an unprecedented golden era.</p>
                <p>Industry analysts point to Seoul’s distinctive narrative approach: an uncompromising willingness to tackle socio-economic themes paired with meticulous production design and dynamic genre fluidity.</p>
                <h3>Global Co-Productions on the Rise</h3>
                <p>Major international studios are now investing directly into Seoul-based writers rooms, fostering multi-language projects scheduled for theatrical debuts across Europe and the Americas in late 2026.</p>
                <p>"Audiences crave emotional sincerity backed by razor-sharp pacing," remarked veteran director Park Chan-woo during an exclusive roundtable with World Eyes News.</p>',
                'image' => 'images/94553609.jpg',
                'image_caption' => 'Award-winning Korean director and ensemble cast at the film festival gala presentation.',
                'is_breaking' => false,
                'is_featured' => true,
                'is_trending' => true,
                'views_count' => 8950,
                'tags' => 'Korean Cinema, Entertainment, Film Festivals, Streaming',
            ],
            [
                'title' => 'Next-Generation Autonomous AI Agents Begin Deployment Across Heavy Manufacturing Logistics',
                'category_slug' => 'technology',
                'summary' => 'Engineering consortiums announce enterprise-grade autonomous reasoning models capable of coordinating robotic assembly and predictive supply chain routing in real time.',
                'content' => '<p>The frontier of artificial intelligence has moved rapidly from conversational chatbots to autonomous physical workflows. In factories spanning Detroit, Munich, and Nagoya, multi-modal reasoning models are now managing full-scale assembly routines without human intervention.</p>
                <h3>Real-Time Optimization</h3>
                <p>These systems synthesize terabytes of telemetry data per second, dynamically rerouting inventory, recalibrating precision robotic arms, and predicting component fatigue days before physical failure occurs.</p>
                <p>Enterprise audits demonstrate a 34% drop in unscheduled factory downtime and a dramatic reduction in micro-defect rates.</p>',
                'image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?w=1200&auto=format&fit=crop&q=80',
                'image_caption' => 'Automated robotic manufacturing cells driven by neural sensory networks.',
                'is_breaking' => true,
                'is_featured' => false,
                'is_trending' => true,
                'views_count' => 11200,
                'tags' => 'AI, Robotics, Technology, Future Tech',
            ],
            [
                'title' => 'Global Central Banks Coordinate Policy Response Amid Shifting Trade Routes and Currency Flows',
                'category_slug' => 'business',
                'summary' => 'Monetary authorities maintain disciplined liquidity measures while evaluating bilateral settlement systems in non-traditional trading corridors.',
                'content' => '<p>Financial markets rallied across European and Asian bourses this morning following a joint communique issued by leading central bank governors. The statement emphasized coordinated stability measures while navigating evolving commodity supply networks.</p>
                <p>Institutional bond yields stabilized as benchmark interest rate projections aligned with softening inflationary pressures in manufacturing hubs.</p>',
                'image' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=1200&auto=format&fit=crop&q=80',
                'image_caption' => 'Financial trading monitors displaying live market indices across global exchanges.',
                'is_breaking' => false,
                'is_featured' => false,
                'is_trending' => true,
                'views_count' => 6700,
                'tags' => 'Finance, Economy, Central Banks, Markets',
            ],
            [
                'title' => 'Champions League Thriller: Historic Comeback Secures Final Spot in Dramatic Stoppage Time',
                'category_slug' => 'sports',
                'summary' => 'A breathtaking 94th-minute curling volley sealed an exhilarating 4-3 aggregate victory, sending 70,000 passionate spectators into delirium.',
                'content' => '<p>Football fans were treated to an instant European classic on Tuesday evening as the tournament underdogs pulled off an unforgettable comeback from a two-goal deficit.</p>
                <p>The tactical masterclass culminated in extra-time pressure, crowned with a sensational long-range strike into the top right corner.</p>',
                'image' => 'https://images.unsplash.com/photo-1508098682722-e99c43a406b2?w=1200&auto=format&fit=crop&q=80',
                'image_caption' => 'Celebrations erupt under stadium lights following the decisive goal in stoppage time.',
                'is_breaking' => false,
                'is_featured' => true,
                'is_trending' => false,
                'views_count' => 15400,
                'tags' => 'Football, UEFA Champions League, Sports, European Football',
            ],
            [
                'title' => 'Deep Space Telescope Captures High-Resolution Evidence of Water Vapor on Temperate Exoplanet',
                'category_slug' => 'science-climate',
                'summary' => 'Spectroscopic signatures confirm atmospheric moisture and trace ozone on an Earth-sized world located 120 light-years away.',
                'content' => '<p>Astrophysicists analyzing data from the flagship space observatory have identified the most conclusive atmospheric atmospheric moisture signatures ever detected outside our solar system.</p>
                <p>Orbiting within its parent star’s habitable zone, the terrestrial exoplanet presents thermal equilibrium compatible with stable surface liquid reservoirs.</p>',
                'image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=1200&auto=format&fit=crop&q=80',
                'image_caption' => 'Artist rendering of the newly characterized temperate exoplanetary system.',
                'is_breaking' => false,
                'is_featured' => false,
                'is_trending' => true,
                'views_count' => 9800,
                'tags' => 'Space, Astronomy, Science, Exoplanets',
            ],
            [
                'title' => 'The Geopolitical Chessboard: Navigating the New Multipolar Architecture in Eurasia',
                'category_slug' => 'opinion',
                'summary' => 'An in-depth analysis of emerging diplomatic pacts, maritime security initiatives, and infrastructure connectivity reshaping international statecraft.',
                'content' => '<p>The 21st-century international order is undeniably transitioning away from unipolar hegemony toward a dynamic, multipolar equilibrium. Regional powers are forging flexible bilateral coalitions built around strategic autonomy and supply-chain diversification.</p>
                <p>Rather than ideological alignments, modern diplomacy is anchored in tangible resource corridors, energy security agreements, and digital infrastructure alliances.</p>',
                'image' => 'https://images.unsplash.com/photo-1541872703-74c5e44368f9?w=1200&auto=format&fit=crop&q=80',
                'image_caption' => 'International delegates convening at the ministerial conference chamber.',
                'is_breaking' => false,
                'is_featured' => false,
                'is_trending' => false,
                'views_count' => 4500,
                'tags' => 'Geopolitics, Analysis, International Relations, Opinion',
            ],
            [
                'title' => 'Breakthrough Quantum Processing Node Achieves Fault-Tolerant Error Correction Threshold',
                'category_slug' => 'technology',
                'summary' => 'Laboratory benchmarks demonstrate a 100-fold reduction in quantum bit decoherence, bringing commercial molecular simulation within reach.',
                'content' => '<p>Physics laboratories in Oxford and Palo Alto have crossed a milestone that experts considered decades away: continuous error suppression on logical qubits operating at cryogenic temperatures.</p>
                <p>This breakthrough is poised to revolutionize pharmaceutical drug discovery, superconducting materials design, and cryptographic systems.</p>',
                'image' => 'https://images.unsplash.com/photo-1635070041078-e363dbe005cb?w=1200&auto=format&fit=crop&q=80',
                'image_caption' => 'Cryogenic dilution refrigerator chamber housing the superconducting quantum processor.',
                'is_breaking' => false,
                'is_featured' => false,
                'is_trending' => false,
                'views_count' => 5300,
                'tags' => 'Quantum Computing, Tech, Physics, Innovation',
            ],
            [
                'title' => 'Box Office Records Shattered: Sci-Fi Epic Surpasses $1 Billion in Second Weekend',
                'category_slug' => 'entertainment',
                'summary' => 'Universal acclaim and sold-out IMAX auditoriums propel director’s original space odyssey into the top five grossing pictures in cinematic history.',
                'content' => '<p>Defying prevailing industry concerns over theatrical fatigue, the visionary sci-fi epic crossed the coveted $1 billion milestone in just twelve days of release.</p>
                <p>Driven by enthusiastic word-of-mouth and repeat viewings on premium large-format screens, international markets contributed over 65% of total ticket sales.</p>',
                'image' => 'https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?w=1200&auto=format&fit=crop&q=80',
                'image_caption' => 'Spectators queuing outside a premier cinema hall on premiere weekend.',
                'is_breaking' => false,
                'is_featured' => false,
                'is_trending' => true,
                'views_count' => 12800,
                'tags' => 'Hollywood, Box Office, Cinema, Entertainment',
            ],
            [
                'title' => 'Formula 1 Grand Prix Preview: Upgraded Aero Packages Set Stage for Desert Showdown',
                'category_slug' => 'sports',
                'summary' => 'Teams introduce radical floor redesigns and sidepod geometries ahead of the twilight street circuit qualifying session.',
                'content' => '<p>With just five points separating the top two title contenders, engineering departments worked around the clock to deliver aerodynamic refinements before Friday practice.</p>
                <p>Simulations indicate tyre degradation under track lighting will prove the decisive strategic element during Sunday’s 57-lap battle.</p>',
                'image' => 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=1200&auto=format&fit=crop&q=80',
                'image_caption' => 'Pit crew conducting rapid tyre change during high-intensity practice run.',
                'is_breaking' => false,
                'is_featured' => false,
                'is_trending' => false,
                'views_count' => 7400,
                'tags' => 'Formula 1, Motorsport, Grand Prix, Racing',
            ]
        ];

        foreach ($articles as $art) {
            $cat = $categories[$art['category_slug']] ?? $categories['world-news'];
            $article = Article::updateOrCreate(
                ['title' => $art['title']],
                [
                    'category_id' => $cat->id,
                    'user_id' => $admin->id,
                    'slug' => Str::slug($art['title']),
                    'summary' => $art['summary'],
                    'content' => $art['content'],
                    'image' => $art['image'],
                    'image_caption' => $art['image_caption'],
                    'is_breaking' => $art['is_breaking'],
                    'is_featured' => $art['is_featured'],
                    'is_trending' => $art['is_trending'],
                    'status' => 'published',
                    'published_at' => now()->subHours(rand(1, 48)),
                    'views_count' => $art['views_count'],
                    'tags' => $art['tags'],
                    'meta_title' => $art['title'] . ' | World Eyes News',
                    'meta_description' => $art['summary'],
                ]
            );

            // Add demo comments for each article
            Comment::create([
                'article_id' => $article->id,
                'name' => 'Alexander Wright',
                'email' => 'alex.wright@example.com',
                'comment' => 'Outstanding analysis and balanced reporting. Truly refreshing to see such depth of investigative coverage.',
                'is_approved' => true,
            ]);

            Comment::create([
                'article_id' => $article->id,
                'name' => 'Dr. Priya Sharma',
                'email' => 'priya.sharma@research.edu',
                'comment' => 'The technical implications discussed here are spot-on. Looking forward to your follow-up reporting on policy implementation.',
                'is_approved' => true,
            ]);
        }
    }
}
