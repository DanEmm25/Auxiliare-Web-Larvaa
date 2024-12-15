<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investment Portfolio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFFFFF;
            margin: 0;
            padding: 0;
        }
        .header {
            padding: 16px;
            background-color: #F8F9FA;
        }
        .header-title {
            font-size: 24px;
            font-weight: 700;
            color: #1A1A1A;
            margin-bottom: 8px;
        }
        .total-invested {
            font-size: 18px;
            font-weight: 600;
            color: #007AFF;
        }
        .card {
            background-color: #FFFFFF;
            margin: 16px;
            padding: 16px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .project-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #1A1A1A;
        }
        .details-container {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .label {
            font-size: 14px;
            color: #666666;
        }
        .value {
            font-size: 14px;
            font-weight: 600;
            color: #1A1A1A;
        }
        .progress-bar {
            height: 8px;
            background-color: #F2F2F7;
            border-radius: 4px;
            margin-top: 16px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            background-color: #4CAF50;
            border-radius: 4px;
        }
        .empty-state {
            padding: 32px;
            text-align: center;
        }
        .empty-state-text {
            font-size: 16px;
            color: #666666;
            line-height: 24px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="header-title">Investment Portfolio</h1>
        <p class="total-invested">Total Invested: ₱0.00</p>
    </div>

    <div class="card">
        <h2 class="project-title">Tech Startup Alpha</h2>
        <div class="details-container">
            <div class="detail-row">
                <span class="label">Your Investment:</span>
                <span class="value">₱50,000.00</span>
            </div>
            <div class="detail-row">
                <span class="label">Project Goal:</span>
                <span class="value">₱1,000,000.00</span>
            </div>
            <div class="detail-row">
                <span class="label">Current Funding:</span>
                <span class="value">₱750,000.00</span>
            </div>
            <div class="detail-row">
                <span class="label">Total Investors:</span>
                <span class="value">5</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 75%;"></div>
            </div>
        </div>
    </div>

    <div class="card">
        <h2 class="project-title">Eco Friendly Solutions</h2>
        <div class="details-container">
            <div class="detail-row">
                <span class="label">Your Investment:</span>
                <span class="value">₱30,000.00</span>
            </div>
            <div class="detail-row">
                <span class="label">Project Goal:</span>
                <span class="value">₱500,000.00</span>
            </div>
            <div class="detail-row">
                <span class="label">Current Funding:</span>
                <span class="value">₱450,000.00</span>
            </div>
            <div class="detail-row">
                <span class="label">Total Investors:</span>
                <span class="value">3</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 90%;"></div>
            </div>
        </div>
    </div>

    <div class="empty-state">
        <p class="empty-state-text">You haven't made any investments yet. Start investing to build your portfolio!</p>
    </div>
</body>
</html>
