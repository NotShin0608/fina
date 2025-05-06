<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include necessary files
require_once 'config/functions.php';

// Get ledger entries
$ledgerEntries = getLedgerEntries();

// Handle search
$searchTerm = '';
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $filteredEntries = [];
    foreach ($ledgerEntries as $entry) {
        if (stripos($entry['description'], $searchTerm) !== false || 
            stripos($entry['reference_number'], $searchTerm) !== false ||
            stripos($entry['account_name'], $searchTerm) !== false) {
            $filteredEntries[] = $entry;
        }
    }
    $ledgerEntries = $filteredEntries;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.php'; ?>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="container-fluid">
        <div class="row">
            <?php include 'includes/sidebar.php'; ?>
            
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">General Ledger</h1>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <form action="" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search transactions..." value="<?php echo htmlspecialchars($searchTerm); ?>">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="add-transaction.php" class="btn btn-success">Add Transaction</a>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Ledger Entries</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Account</th>
                                        <th>Date</th>
                                        <th>Reference</th>
                                        <th>Description</th>
                                        <th class="text-end">Debit</th>
                                        <th class="text-end">Credit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ledgerEntries as $entry): ?>
                                    <tr>
                                        <td><?php echo $entry['account_code'] . ' - ' . $entry['account_name']; ?></td>
                                        <td><?php echo date('Y-m-d', strtotime($entry['transaction_date'])); ?></td>
                                        <td><?php echo $entry['reference_number']; ?></td>
                                        <td><?php echo $entry['description']; ?></td>
                                        <td class="text-end"><?php echo $entry['debit_amount'] > 0 ? formatCurrency($entry['debit_amount']) : ''; ?></td>
                                        <td class="text-end"><?php echo $entry['credit_amount'] > 0 ? formatCurrency($entry['credit_amount']) : ''; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php if (empty($ledgerEntries)): ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No ledger entries found</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>
