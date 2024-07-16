<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Detailed Calendar</title>
        <link rel="stylesheet" href="{{ asset('css/dai.css') }}"> 
        <link rel="stylesheet" href="{{ asset('css/dai1.css') }}">
    </head>
    <body>
        <div class="image" style="background-image: url('{{ asset('images/fl.jpg') }}');"></div>
        <div id="calendar-container">
            <h2 id="month-year"></h2>
            <button id="prev-btn">&lt;</button>
            <button id="next-btn">&gt;</button>
            <div id="days-grid"></div>
            <br>
            <br> 
            <a href="/" class="btn-primary mt-3 ">Back </a>
        </div>

    </body>

    <script>
    /**calander js */
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

            // Function to generate days for the current month
            function generateDays() {
                const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay();
                const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
                let daysHtml = '';

                for (let i = 1; i <= daysInMonth; i++) {
                    daysHtml += `<div class="day-box">${i}</div>`;
                }

                daysGrid.innerHTML = daysHtml;

                const dayBoxes = document.querySelectorAll('.day-box');
                dayBoxes.forEach(box => {
                    box.addEventListener('click', function() {
                        const dayBox = parseInt(this.textContent, 10);
                        const dayOfYear = calculateDayOfYear(new Date(currentYear, currentMonth, dayBox));
                        navigateToDayPage(currentYear, currentMonth + 1, dayBox);
                    });
                });
            }

            // Function to navigate to a specific day page
            function navigateToDayPage(year, month, day) {
                const formattedDate = `${year}${String(month).padStart(2, '0')}${String(day).padStart(2, '0')}`;
                console.log(`Navigating to day: ${formattedDate}`);
                window.location.href = `/day/${formattedDate}`;
            }

            // Function to calculate the day of the year
            function calculateDayOfYear(date) {
                date.setDate(1);
                date.setDate(date.getDate() - 1);
                return date.getDate();
            }

            // Function to update the month and year display
            function updateMonthYear() {
                monthYearEl.textContent = `${monthNames[currentMonth]} ${currentYear}`;
            }

            // Function to navigate to the previous or next month
            function navigateMonths(direction) {
                if (direction === 'prev') {
                    if (currentMonth === 0) { // Transitioning from December to January
                        currentMonth = 11;
                        currentYear--;
                    } else {
                        currentMonth--;
                    }
                } else { // Navigating to the next month
                    if (currentMonth === 11) { // Transitioning from November to December
                        currentMonth = 0;
                        currentYear++;
                    } else {
                        currentMonth++;
                    }
                }
                updateMonthYear();
                generateDays(); // Regenerate days for the new month
            }

            // Event listeners for navigation buttons
            prevBtn.addEventListener('click', function() {
                navigateMonths('prev');
            });

            nextBtn.addEventListener('click', function() {
                navigateMonths('next');
            });

            // Initial setup
            updateMonthYear();
            generateDays();
        });

        function navigateToDayPage(year, month, day) {
            const formattedDate = `${year}${String(month).padStart(2, '0')}${String(day).padStart(2, '0')}`;
            console.log(`Navigating to day: ${formattedDate}`);
            window.location.href = `/day/${formattedDate}`;

            // Remove active-day class from all day boxes
            const dayBoxes = document.querySelectorAll('.day-box');
            dayBoxes.forEach(box => {
                box.classList.remove('active-day');
            });

            // Add active-day class to the clicked day box
            document.querySelector(`.day-box:nth-child(${day})`).classList.add('active-day');
        }


    </script>
    </body>
</html>
