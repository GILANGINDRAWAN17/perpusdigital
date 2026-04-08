<script src="//unpkg.com/alpinejs" defer></script>
<script>
    function timeAgo(time) {
        const now = new Date();
        const past = new Date(time);
        const diff = Math.floor((now - past) / 1000);

        if (diff < 60) return 'Baru saja';
        if (diff < 3600) return Math.floor(diff / 60) + ' menit lalu';
        if (diff < 86400) return Math.floor(diff / 3600) + ' jam lalu';

        return Math.floor(diff / 86400) + ' hari lalu';
    }

    function loadNotifikasi() {
        fetch('/notifikasi/data')
            .then(res => res.json())
            .then(data => {

                let html = '';
                let unread = 0;

                data.forEach(notif => {

                    if (!notif.is_read) unread++;

                    let icon = 'bell';
                    let color = 'text-blue-500';

                    if (notif.pesan.includes('disetujui')) {
                        icon = 'check-circle';
                        color = 'text-green-500';
                    } else if (notif.pesan.includes('ditolak')) {
                        icon = 'x-circle';
                        color = 'text-red-500';
                    } else if (notif.pesan.includes('jatuh tempo')) {
                        icon = 'clock';
                        color = 'text-yellow-500';
                    }

                    html += `
                    <div onclick="markAsRead(${notif.id})"
                        class="p-4 hover:bg-gray-50 border-b text-sm flex items-start gap-3 cursor-pointer 
                        ${notif.is_read ? 'opacity-50' : ''}">

                        <i data-lucide="${icon}" class="w-5 h-5 ${color} mt-1"></i>

                        <div>
                            <span class="font-medium text-[#004d4d]">
                                ${notif.pesan}
                            </span>

                            <div class="text-xs text-gray-400 mt-1">
                                ${timeAgo(notif.created_at)}
                            </div>
                        </div>
                    </div>
                    `;
                });

                if (html === '') {
                    html = `<div class="p-4 text-sm text-gray-400 text-center">
                        Tidak ada notifikasi
                    </div>`;
                }

                document.getElementById('notif-list').innerHTML = html;
                document.getElementById('notif-badge').innerText = unread;

                if (unread === 0) {
                    badge.classList.add('hidden');
                } else {
                    badge.classList.remove('hidden');
                    badge.classList.add('flex');
                    badge.innerText = unread;
                }
            });
    }

    function markAsRead(id) {
        fetch(`/notifikasi/${id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    loadNotifikasi();
                }
            });
    }

    // 🔥 LOAD AWAL
    document.addEventListener('DOMContentLoaded', () => {
        loadNotifikasi();

        // 🔥 AUTO REFRESH
        setInterval(loadNotifikasi, 5000);
    });
</script>
