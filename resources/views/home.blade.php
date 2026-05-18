<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Management Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    /* ---- Reset & Base ---- */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Segoe UI', Inter, system-ui, sans-serif;
      background: #f1f5f9;
      color: #111827;
      min-height: 100vh;
    }

    /* ---- Top Navbar ---- */
    .navbar {
      background: #fff;
      border-bottom: 1px solid #e5eaf2;
      padding: 0 2rem;
      height: 64px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0 1px 4px rgba(0,0,0,0.06);
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .navbar__brand {
      display: flex;
      align-items: center;
      gap: 0.65rem;
      font-size: 1.1rem;
      font-weight: 700;
      color: #1e3a5f;
      text-decoration: none;
    }

    .navbar__brand i {
      color: #2563eb;
      font-size: 1.3rem;
    }

    .navbar__right {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .navbar__avatar {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: linear-gradient(135deg, #1e3a5f, #2563eb);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.85rem;
      font-weight: 600;
      cursor: pointer;
    }

    /* ---- Page Layout ---- */
    .page {
      max-width: 1000px;
      margin: 2.5rem auto;
      padding: 0 1.5rem;
      display: flex;
      flex-direction: column;
      gap: 1.75rem;
    }

    /* ---- Welcome / Hero Card ---- */
    .welcome-card {
      display: flex;
      align-items: center;
      gap: 1.75rem;
      background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 100%);
      border-radius: 16px;
      padding: 2.25rem 2.5rem;
      color: #fff;
      box-shadow: 0 8px 32px rgba(37, 99, 235, 0.25);
    }

    .welcome-card__icon {
      flex-shrink: 0;
      width: 72px;
      height: 72px;
      background: rgba(255,255,255,0.15);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      backdrop-filter: blur(4px);
    }

    .welcome-card__body {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .welcome-card__title {
      font-size: 1.5rem;
      font-weight: 700;
      letter-spacing: -0.02em;
      line-height: 1.3;
    }

    .welcome-card__subtitle {
      font-size: 0.95rem;
      opacity: 0.85;
      max-width: 520px;
      line-height: 1.6;
    }

    /* ---- Button ---- */
    .btn {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.625rem 1.375rem;
      border-radius: 8px;
      font-size: 0.9rem;
      font-weight: 600;
      text-decoration: none;
      transition: background 0.18s ease, transform 0.12s ease, box-shadow 0.18s ease;
      cursor: pointer;
      border: none;
    }

    .btn--primary {
      background: #fff;
      color: #1e3a5f;
      align-self: flex-start;
      margin-top: 0.5rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.12);
    }

    .btn--primary:hover {
      background: #f0f6ff;
      transform: translateY(-1px);
      box-shadow: 0 4px 16px rgba(0,0,0,0.15);
    }

    /* ---- Stats Grid ---- */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 1.25rem;
    }

    /* ---- Stat Card ---- */
    .stat-card {
      display: flex;
      align-items: center;
      gap: 1.25rem;
      background: #fff;
      border: 1px solid #e5eaf2;
      border-radius: 14px;
      padding: 1.5rem 1.75rem;
      box-shadow: 0 2px 12px rgba(0,0,0,0.05);
      transition: box-shadow 0.2s ease, transform 0.15s ease;
    }

    .stat-card:hover {
      box-shadow: 0 6px 24px rgba(0,0,0,0.09);
      transform: translateY(-2px);
    }

    .stat-card__icon {
      flex-shrink: 0;
      width: 52px;
      height: 52px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.35rem;
    }

    .stat-card__icon--blue  { background: #eff6ff; color: #2563eb; }
    .stat-card__icon--green { background: #f0fdf4; color: #16a34a; }
    .stat-card__icon--amber { background: #fffbeb; color: #d97706; }

    .stat-card__body { display: flex; flex-direction: column; gap: 0.2rem; }

    .stat-card__value {
      font-size: 1.65rem;
      font-weight: 700;
      color: #111827;
      line-height: 1;
      letter-spacing: -0.02em;
    }

    .stat-card__label {
      font-size: 0.82rem;
      color: #6b7280;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.04em;
    }

    /* ---- Section Title ---- */
    .section-title {
      font-size: 1rem;
      font-weight: 700;
      color: #374151;
      margin-bottom: 0.25rem;
      letter-spacing: -0.01em;
    }

    /* ---- Quick Actions ---- */
    .quick-actions {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      gap: 1rem;
    }

    .action-card {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      gap: 0.75rem;
      background: #fff;
      border: 1px solid #e5eaf2;
      border-radius: 14px;
      padding: 1.35rem 1.5rem;
      text-decoration: none;
      color: #111827;
      box-shadow: 0 2px 8px rgba(0,0,0,0.04);
      transition: box-shadow 0.2s ease, transform 0.15s ease, border-color 0.2s ease;
    }

    .action-card:hover {
      box-shadow: 0 6px 20px rgba(37,99,235,0.1);
      border-color: #bfdbfe;
      transform: translateY(-2px);
    }

    .action-card__icon {
      width: 42px;
      height: 42px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
    }

    .action-card__label {
      font-size: 0.9rem;
      font-weight: 600;
      color: #1e3a5f;
    }

    .action-card__desc {
      font-size: 0.78rem;
      color: #6b7280;
      line-height: 1.4;
    }

    /* ---- Responsive ---- */
    @media (max-width: 640px) {
      .welcome-card {
        flex-direction: column;
        align-items: flex-start;
        padding: 1.75rem;
      }
      .welcome-card__title { font-size: 1.2rem; }
      .stats-grid, .quick-actions { grid-template-columns: 1fr; }
      .navbar { padding: 0 1rem; }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar">
    <a href="#" class="navbar__brand">
      <i class="fas fa-graduation-cap"></i>
      EduTrack
    </a>
    <div class="navbar__right">
      <div class="navbar__avatar">AD</div>
    </div>
  </nav>

  <!-- Main Page -->
  <main class="page">

    <!-- Hero / Welcome Card -->
    <div class="welcome-card">
      <div class="welcome-card__icon">
        <i class="fas fa-graduation-cap"></i>
      </div>
      <div class="welcome-card__body">
        <h1 class="welcome-card__title">Student Management Dashboard</h1>
        <p class="welcome-card__subtitle">Keep student records organized, add new students quickly, and track enrollment at a glance.</p>
        <a href="{{ route('students.index') }}" class="btn btn--primary">
          <i class="fas fa-users"></i>
          View Students
        </a>

      </div>
    </div>

    <!-- Stats -->
    <div>
      <p class="section-title">Overview</p>
      <div style="height:0.75rem;"></div>
      <div class="stats-grid">

        <div class="stat-card">
          <div class="stat-card__icon stat-card__icon--blue">
            <i class="fas fa-user-graduate"></i>
          </div>
          <div class="stat-card__body">
            <span class="stat-card__value">{{ $studentCount }}</span>
            <span class="stat-card__label">Total Students Registered</span>
          </div>
        </div>

        <div class="stat-card">
          <!-- Green when students exist, amber when none -->
          <div class="stat-card__icon stat-card__icon--green">
            <i class="fas fa-check-circle"></i>
          </div>
          <div class="stat-card__body">
            <span class="stat-card__value">Active</span>
            <span class="stat-card__label">System active</span>
          </div>
        </div>

      </div>
    </div>

    <!-- Quick Actions -->
    <div>
      <p class="section-title">Quick Actions</p>
      <div style="height:0.75rem;"></div>
      <div class="quick-actions">

        <a href="{{ route('students.create') }}" class="action-card">
          <div class="action-card__icon" style="background:#eff6ff; color:#2563eb;">
            <i class="fas fa-user-plus"></i>
          </div>
          <span class="action-card__label">Add Student</span>
          <span class="action-card__desc">Register a new student to the system.</span>
        </a>

        <a href="{{ route('students.index') }}" class="action-card">
          <div class="action-card__icon" style="background:#f0fdf4; color:#16a34a;">
            <i class="fas fa-list"></i>
          </div>
          <span class="action-card__label">View All Students</span>
          <span class="action-card__desc">Browse and manage all student records.</span>
        </a>

        <a href="{{ route('borrowings.index') }}" class="action-card">
          <div class="action-card__icon" style="background:#fdf4ff; color:#9333ea;">
            <i class="fas fa-chart-bar"></i>
          </div>
          <span class="action-card__label">Reports</span>
          <span class="action-card__desc">View enrollment and activity reports.</span>
        </a>

        <a href="{{ route('home') }}" class="action-card">
          <div class="action-card__icon" style="background:#fffbeb; color:#d97706;">
            <i class="fas fa-cog"></i>
          </div>
          <span class="action-card__label">Settings</span>
          <span class="action-card__desc">Configure your dashboard preferences.</span>
        </a>


      </div>
    </div>

  </main>

</body>
</html>

