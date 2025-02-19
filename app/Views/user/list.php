<h2>User List</h2>
<ul>
    <?php foreach ($users as $user): ?>
        <li>
            <?php echo htmlspecialchars($user['name']); ?> - 
            <?php echo (time() - strtotime($user['last_active']) < 300) ? 'Online' : 'Offline'; ?>
        </li>
    <?php endforeach; ?>
</ul> 