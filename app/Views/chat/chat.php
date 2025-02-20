<head>
    <link rel="stylesheet" href="/live-chat/public/css/chat-styles.css">
</head>

<h2>Chat</h2>
<a href="/live-chat/public/index.php/logout">Logout</a>
<div id="user-list">
    <h3>Users Online</h3>
    <ul>
        <?php foreach ($users as $user): ?>
            <li>
                <?php echo htmlspecialchars($user['name']); ?> - 
                <?php echo (time() - strtotime($user['last_active']) < 300) ? 'Online' : 'Offline'; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<div id="chat-box" style="border: 1px solid #ccc; padding: 10px; height: 300px; overflow-y: scroll;">
    <!-- Messages will be loaded here -->
</div>

<!-- Add buttons for archiving and deleting all messages -->
<div class="button-container">
    <button onclick="archiveAllMessages()">Archive All</button>
    <button onclick="deleteAllMessages()">Delete All</button>
</div>

<form id="chat-form">
    <select name="receiver_id">
        <?php foreach ($users as $user): ?>
            <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['name']); ?></option>
        <?php endforeach; ?>
    </select>
    <textarea name="content" placeholder="Type your message here..." required></textarea>
    <button type="submit">Send</button>
</form>

<script>
document.getElementById('chat-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const receiverId = this.querySelector('select[name="receiver_id"]').value;
    const content = this.querySelector('textarea[name="content"]').value;

    fetch('/live-chat/public/index.php/chat/send', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            receiver_id: receiverId,
            content: content
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            this.content.value = '';
            fetchMessages();
        } else {
            console.error('Error sending message:', data.message);
        }
    });
});
</script>

<script src="/live-chat/public/js/chat.js"></script>
