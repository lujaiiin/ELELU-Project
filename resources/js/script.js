// script.js
document.addEventListener("DOMContentLoaded", function() {
    const monthYearEl = document.getElementById('month-year');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const daysGrid = document.getElementById('days-grid');
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();
    const monthNames = ["January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"];

    function generateDays() {
        const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay();
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
        let daysHtml = '';

        for (let i = 1; i <= daysInMonth; i++) {
            daysHtml += `<div class="day-box">${i}</div>`;
        }

        daysGrid.innerHTML = daysHtml;
    }

    function updateMonthYear() {
        monthYearEl.textContent = `${monthNames[currentMonth]} ${currentYear}`;
    }

    function navigateMonths(direction) {
        if (direction === 'prev') {
            if (currentMonth === 0) {
                currentMonth = 11;
                currentYear--;
            } else {
                currentMonth--;
            }
        } else { // next
            if (currentMonth === 11) {
                currentMonth = 0;
                currentYear++;
            } else {
                currentMonth++;
            }
        }
        updateMonthYear();
        generateDays();
    }

    prevBtn.addEventListener('click', function() {
        navigateMonths('prev');
    });

    nextBtn.addEventListener('click', function() {
        navigateMonths('next');
    });

    updateMonthYear();
    generateDays();
});
