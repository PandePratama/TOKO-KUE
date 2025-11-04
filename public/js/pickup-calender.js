document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('pickupCalendar');
    if (!calendarEl) return;

    // Ambil data tanggal dari atribut data-* yang dikirim Blade
    var pickupDates = JSON.parse(calendarEl.dataset.pickupDates || "[]");

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,
        events: pickupDates.map(date => ({
            title: 'Tersedia',
            start: date,
            display: 'background',
            color: '#19875440' // warna hijau transparan
        })),
        dateClick: function (info) {
            const selected = info.dateStr;
            if (pickupDates.includes(selected)) {
                document.getElementById('selectedDate').value = selected;
                alert('Tanggal pengambilan dipilih: ' + selected);
            } else {
                alert('Tanggal ' + selected + ' tidak tersedia untuk pengambilan.');
            }
        }
    });

    calendar.render();
});
