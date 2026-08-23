import '../css/app.css';

window.futaHeroSearch = (locale, today) => ({
    roundTrip: false,
    departure: '',
    destination: '',
    departureDate: today,
    returnDate: '',
    calendarOpen: null,
    calendarYear: Number(today.slice(0, 4)),
    calendarMonth: Number(today.slice(5, 7)) - 1,
    calendarWeekdays: locale === 'vi'
        ? ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN']
        : ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],

    swapLocations() {
        [this.departure, this.destination] = [this.destination, this.departure];
    },

    setRoundTrip(enabled) {
        this.roundTrip = enabled;

        if (!enabled && this.calendarOpen === 'return') {
            this.calendarOpen = null;
        }
    },

    toIsoDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');

        return `${year}-${month}-${day}`;
    },

    openCalendar(type) {
        const selectedDate = type === 'departure' ? this.departureDate : this.returnDate;
        const baseDate = selectedDate || this.departureDate || today;
        const [year, month] = baseDate.split('-').map(Number);

        this.calendarYear = year;
        this.calendarMonth = month - 1;
        this.calendarOpen = this.calendarOpen === type ? null : type;
    },

    moveCalendarMonth(offset) {
        const date = new Date(this.calendarYear, this.calendarMonth + offset, 1);
        this.calendarYear = date.getFullYear();
        this.calendarMonth = date.getMonth();
    },

    calendarTitle() {
        return new Intl.DateTimeFormat(locale === 'vi' ? 'vi-VN' : 'en-US', {
            month: 'long',
            year: 'numeric',
        }).format(new Date(this.calendarYear, this.calendarMonth, 1));
    },

    calendarDays() {
        const firstDay = new Date(this.calendarYear, this.calendarMonth, 1);
        const mondayOffset = (firstDay.getDay() + 6) % 7;
        const startDate = new Date(this.calendarYear, this.calendarMonth, 1 - mondayOffset);

        return Array.from({ length: 42 }, (_, index) => {
            const date = new Date(startDate);
            date.setDate(startDate.getDate() + index);

            return {
                iso: this.toIsoDate(date),
                day: date.getDate(),
                currentMonth: date.getMonth() === this.calendarMonth,
            };
        });
    },

    calendarMinDate() {
        return this.calendarOpen === 'return' ? this.departureDate : today;
    },

    selectedCalendarDate() {
        return this.calendarOpen === 'return' ? this.returnDate : this.departureDate;
    },

    selectCalendarDate(day) {
        if (day.iso < this.calendarMinDate()) {
            return;
        }

        if (this.calendarOpen === 'return') {
            this.returnDate = day.iso;
        } else {
            this.departureDate = day.iso;

            if (this.returnDate && this.returnDate < day.iso) {
                this.returnDate = '';
            }
        }

        this.calendarOpen = null;
    },

    formatDate(value) {
        if (!value) {
            return '';
        }

        const [year, month, day] = value.split('-');
        return `${day}/${month}/${year}`;
    },

    weekdayLabel(value) {
        if (!value) {
            return '';
        }

        const [year, month, day] = value.split('-').map(Number);
        return new Intl.DateTimeFormat(locale === 'vi' ? 'vi-VN' : 'en-US', {
            weekday: 'short',
        }).format(new Date(year, month - 1, day));
    },
});
