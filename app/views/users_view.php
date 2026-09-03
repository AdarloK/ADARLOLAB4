<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management Dashboard</title>
    <style>
        :root {
            --bg: #07111f;
            --bg-soft: #0f1d2d;
            --panel: rgba(15, 29, 45, 0.9);
            --panel-strong: #14273d;
            --panel-alt: #0b1728;
            --card: rgba(17, 31, 48, 0.92);
            --line: rgba(148, 163, 184, 0.18);
            --line-strong: rgba(96, 165, 250, 0.35);
            --text: #ecf4ff;
            --muted: #90a4bd;
            --muted-strong: #b4c8dc;
            --primary: #7c9cff;
            --primary-strong: #5d7ef7;
            --secondary: #8ef0d2;
            --accent: #ffb86c;
            --danger: #ff7d7d;
            --shadow: 0 18px 50px rgba(10, 18, 31, 0.45);
            --radius-xl: 26px;
            --radius-lg: 18px;
            --radius-md: 12px;
        }

        * { box-sizing: border-box; }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(124, 156, 255, 0.18), transparent 22%),
                radial-gradient(circle at bottom right, rgba(142, 240, 210, 0.08), transparent 25%),
                linear-gradient(135deg, var(--bg) 0%, #0c1728 38%, #091623 100%);
            color: var(--text);
        }

        .app-shell {
            display: grid;
            grid-template-columns: 260px minmax(0, 1fr);
            min-height: 100vh;
            gap: 24px;
            padding: 24px;
        }

        .sidebar {
            background: rgba(9, 17, 29, 0.8);
            border: 1px solid var(--line);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow);
            padding: 22px 18px;
            display: flex;
            flex-direction: column;
            gap: 24px;
            backdrop-filter: blur(12px);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: var(--radius-md);
        }

        .brand-mark {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            display: grid;
            place-items: center;
            color: #04101c;
            font-weight: 800;
            box-shadow: 0 0 25px rgba(124, 156, 255, 0.5);
        }

        .brand-copy {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }

        .brand-copy strong {
            font-size: 1rem;
            letter-spacing: 0.02em;
        }

        .brand-copy span {
            color: var(--muted);
            font-size: 0.72rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .nav-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .nav-label {
            font-size: 0.7rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--muted);
            padding: 0 12px 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 12px;
            color: var(--muted-strong);
            text-decoration: none;
            transition: 0.2s ease;
            border: 1px solid transparent;
        }

        .nav-item:hover,
        .nav-item.active {
            background: rgba(124, 156, 255, 0.1);
            border-color: rgba(124, 156, 255, 0.25);
            color: var(--text);
        }

        .nav-icon {
            width: 30px;
            height: 30px;
            border-radius: 10px;
            background: rgba(148, 163, 184, 0.08);
            display: grid;
            place-items: center;
            font-size: 0.8rem;
        }

        .sidebar-footer {
            margin-top: auto;
            background: linear-gradient(135deg, rgba(124, 156, 255, 0.12), rgba(142, 240, 210, 0.08));
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            padding: 16px 14px;
        }

        .sidebar-footer small {
            display: block;
            color: var(--muted);
            margin-bottom: 10px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .mini-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .mini-card strong {
            display: block;
            font-size: 1.2rem;
        }

        .mini-card span {
            color: var(--secondary);
            font-size: 0.78rem;
            font-weight: 600;
        }

        .content {
            background: rgba(9, 17, 29, 0.55);
            border: 1px solid var(--line);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow);
            padding: 24px;
            backdrop-filter: blur(12px);
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 26px;
        }

        .topbar h1 {
            margin: 0;
            font-size: clamp(2rem, 3vw, 2.7rem);
            letter-spacing: -0.05em;
        }

        .topbar-meta {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .search {
            border: 1px solid var(--line);
            background: rgba(12, 24, 37, 0.8);
            color: var(--text);
            border-radius: 12px;
            padding: 11px 14px;
            min-width: 220px;
            outline: none;
        }

        .action-btn {
            border: 1px solid rgba(124, 156, 255, 0.35);
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-strong) 100%);
            color: white;
            border-radius: 12px;
            padding: 11px 18px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 10px 28px rgba(93, 126, 247, 0.35);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 22px;
        }

        .stat-card {
            background: linear-gradient(180deg, rgba(20, 39, 61, 0.9), rgba(13, 24, 37, 0.9));
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            padding: 18px 18px 16px;
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: var(--muted);
            font-size: 0.76rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 18px;
        }

        .chip {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            background: rgba(124, 156, 255, 0.12);
            color: var(--primary);
            font-weight: 700;
        }

        .stat-value {
            font-size: clamp(1.5rem, 2vw, 2.1rem);
            font-weight: 700;
            letter-spacing: -0.05em;
            margin-bottom: 8px;
        }

        .stat-trend {
            font-size: 0.8rem;
            color: var(--secondary);
        }

        .panel {
            background: linear-gradient(180deg, rgba(17, 32, 49, 0.9), rgba(11, 20, 31, 0.9));
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 18px 20px;
            border-bottom: 1px solid var(--line);
            background: rgba(12, 24, 37, 0.7);
        }

        .panel-header h2 {
            margin: 0;
            font-size: 1rem;
            letter-spacing: 0.04em;
        }

        .panel-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 7px 10px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--secondary);
            background: rgba(142, 240, 210, 0.08);
            border: 1px solid rgba(142, 240, 210, 0.18);
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 760px;
            border-collapse: collapse;
        }

        th, td {
            padding: 18px 20px;
            border-bottom: 1px solid var(--line);
            text-align: left;
        }

        th {
            font-size: 0.72rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--muted);
            background: rgba(10, 17, 27, 0.75);
        }

        td {
            color: var(--muted-strong);
            font-size: 0.96rem;
        }

        tbody tr:hover {
            background: rgba(124, 156, 255, 0.04);
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(124, 156, 255, 0.2), rgba(142, 240, 210, 0.2));
            border: 1px solid rgba(124, 156, 255, 0.35);
            display: grid;
            place-items: center;
            font-weight: 700;
            color: var(--text);
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 10px;
            border-radius: 999px;
            font-size: 0.76rem;
            font-weight: 700;
            border: 1px solid transparent;
        }

        .status::before {
            content: "";
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
            display: inline-block;
        }

        .status.online {
            color: var(--secondary);
            background: rgba(142, 240, 210, 0.08);
            border-color: rgba(142, 240, 210, 0.18);
        }

        .status.pending {
            color: var(--accent);
            background: rgba(255, 184, 108, 0.08);
            border-color: rgba(255, 184, 108, 0.15);
        }

        .status.offline {
            color: var(--muted);
            background: rgba(148, 163, 184, 0.08);
            border-color: rgba(148, 163, 184, 0.18);
        }

        .email {
            color: #dfeaf7;
        }

        .empty-state {
            text-align: center;
            padding: 36px 20px;
            color: var(--muted);
            font-size: 0.96rem;
        }

        @media (max-width: 980px) {
            .app-shell {
                grid-template-columns: 1fr;
            }

            .sidebar {
                padding: 18px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .app-shell {
                padding: 14px;
                gap: 14px;
            }

            .content {
                padding: 16px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .topbar-meta {
                width: 100%;
                flex-wrap: wrap;
            }

            .search {
                flex: 1;
                min-width: 0;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="app-shell">
        <aside class="sidebar">
            <div class="brand">
                <div class="brand-mark">L</div>
                <div class="brand-copy">
                    <strong>LavaLust</strong>
                    <span>Admin</span>
                </div>
            </div>

            <nav class="nav-group" aria-label="Sidebar navigation">
                <div class="nav-label">Overview</div>
                <a class="nav-item active" href="#">
                    <span class="nav-icon">◫</span>
                    <span>Dashboard</span>
                </a>
                <a class="nav-item" href="#">
                    <span class="nav-icon">◎</span>
                    <span>Users</span>
                </a>
                <a class="nav-item" href="#">
                    <span class="nav-icon">▣</span>
                    <span>Reports</span>
                </a>
                <a class="nav-item" href="#">
                    <span class="nav-icon">✦</span>
                    <span>Settings</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <small>System health</small>
                <div class="mini-card">
                    <div>
                        <strong>99.8%</strong>
                        <span>Uptime</span>
                    </div>
                    <span class="pill">Stable</span>
                </div>
            </div>
        </aside>

        <main class="content">
            <header class="topbar">
                <h1>Users</h1>
                <div class="topbar-meta">
                    <input class="search" type="text" value="Search users" aria-label="Search users" />
                    <button class="action-btn" type="button">Add user</button>
                </div>
            </header>

            <section class="stats-grid" aria-label="Users overview">
                <article class="stat-card">
                    <div class="stat-top">
                        <span>Total users</span>
                        <span class="chip">U</span>
                    </div>
                    <div class="stat-value"><?= count($users ?? []) ?></div>
                    <div class="stat-trend">+12.4% from last month</div>
                </article>
                <article class="stat-card">
                    <div class="stat-top">
                        <span>Active</span>
                        <span class="chip">A</span>
                    </div>
                    <div class="stat-value">89%</div>
                    <div class="stat-trend">+4.2% improvement</div>
                </article>
                <article class="stat-card">
                    <div class="stat-top">
                        <span>New today</span>
                        <span class="chip">N</span>
                    </div>
                    <div class="stat-value">18</div>
                    <div class="stat-trend">Across all teams</div>
                </article>
                <article class="stat-card">
                    <div class="stat-top">
                        <span>Engagement</span>
                        <span class="chip">E</span>
                    </div>
                    <div class="stat-value">74%</div>
                    <div class="stat-trend">Healthy usage</div>
                </article>
            </section>

            <section class="panel" aria-label="User registry table">
                <div class="panel-header">
                    <h2>Registry</h2>
                    <div class="panel-actions">
                        <span class="pill"><?= count($users ?? []) ?> records</span>
                    </div>
                </div>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <?php
                                        $status = 'online';
                                        $displayName = htmlspecialchars(trim(($user['firstname'] ?? '') . ' ' . ($user['lastname'] ?? '')), ENT_QUOTES, 'UTF-8');
                                        if ($displayName === '') {
                                            $displayName = 'Unknown User';
                                        }
                                        $initials = strtoupper(substr((string)($user['firstname'] ?? 'U'), 0, 1) . substr((string)($user['lastname'] ?? 'S'), 0, 1));
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="user-cell">
                                                <div class="avatar"><?= htmlspecialchars($initials, ENT_QUOTES, 'UTF-8') ?></div>
                                                <span><?= $displayName ?></span>
                                            </div>
                                        </td>
                                        <td><?= htmlspecialchars($user['firstname'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($user['lastname'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                        <td class="email"><?= htmlspecialchars($user['email'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><?= htmlspecialchars($user['username'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                        <td><span class="status <?= $status ?>"><?= ucfirst($status) ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td class="empty-state" colspan="6">No users found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
