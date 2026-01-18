<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>403 | Access Denied</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        :root {
            --primary: #2563eb;
            --bg: #0f172a;
            --card: #020617;
            --text: #e5e7eb;
            --muted: #94a3b8;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            min-height: 100vh;
            background: radial-gradient(circle at top, #1e293b, var(--bg));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text);
        }

        .card {
            background: linear-gradient(180deg, #020617, #020617);
            border: 1px solid #1e293b;
            border-radius: 16px;
            padding: 40px;
            max-width: 420px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 50px rgba(0,0,0,.5);
        }

        .icon {
            font-size: 64px;
            margin-bottom: 16px;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 12px;
        }

        p {
            color: var(--muted);
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 14px;
            transition: .2s ease;
        }

        .btn-primary {
            background: var(--primary);
            color: #fff;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-outline {
            border: 1px solid #334155;
            color: var(--text);
        }

        .btn-outline:hover {
            background: #020617;
            border-color: #475569;
        }

        footer {
            margin-top: 24px;
            font-size: 12px;
            color: #64748b;
        }

        @media (max-width: 480px) {
            .card {
                padding: 28px;
            }
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="icon">🚫</div>
        <h1>403 – Access Denied</h1>

        <p>
            This area of the application is restricted.<br>
            You may not have the required permissions, or the resource is protected.
        </p>

        <div class="actions">
            <a href="<?= url('/') ?>" class="btn btn-primary">Go Home</a>
            <a href="javascript:history.back()" class="btn btn-outline">Go Back</a>
        </div>

        <footer>
            If you believe this is an error, please contact the administrator.
        </footer>
    </div>

</body>
</html>
