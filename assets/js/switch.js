function toggleLabel() {
    const backupSwitch = document.getElementById('backupSwitch');
    const label = document.querySelector('label[for="backupSwitch"]');

    if (backupSwitch.checked) {
        label.innerText = 'Automatic Backup Database';
    } else {
        label.innerText = 'Manual Backup Database';
    }
}
