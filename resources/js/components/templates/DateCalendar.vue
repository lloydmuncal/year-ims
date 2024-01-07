<template>
    <div class=" shadow-3xl h-fit border-2 border-gray-600 ">
      <div class="flex text-center font-bold gap-2  bg-gray-700 p-2 ">
        <!-- Year dropdown -->
        <div class="relative">
          <select v-model="currentYear" @input="selectYear" class="p-1  border-2 border-gray-600 bg-white ">
            <option v-for="year in years" :value="year">{{ year }}</option>
          </select>
        </div>
        <!-- Month dropdown -->
        <div class="relative">
          <select v-model="currentMonth" @input="selectMonth" class="p-1  border-2 border-gray-600 bg-white">
            <option v-for="(month, index) in months" :value="index">{{ month }}</option>
          </select>
        </div>
      </div>
      <div class="grid grid-cols-7 gap-1 mt-2 p-2">
        <div
          v-for="day in ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']"
          :key="day"
          class="text-center font-bold flex justify-center   border-2 border-gray-600 p-1 "
        >
          {{ day }}
        </div>
        <div v-for="i in startDay" :key="i" class="text-center text-gray-400"></div>
        <div
          v-for="day in daysInMonth"
          :key="day"
          @mouseover="hoveredDay = day"
          @mouseout="hoveredDay = null"
          :class="{
            'bg-blue-500 text-white': isSelectedDate(day),
            'hover:bg-blue-400 cursor-pointer': hoveredDay === day && !isSelectedDate(day),
            'border bg-blue-500': isCurrentDate(day),
          }"
          class="text-center font-semibold flex justify-center  border-2 border-gray-600  p-1"
          @click="selectDate(day)"
        >
          {{ day }}
        </div>
      </div>
    </div>
  </template>

  <script>
  import { startOfMonth, addMonths, addYears, getMonth, getYear, isSameDay } from 'date-fns';

  export default {
    props: {
      modelValue: Date,
    },
    data() {
      const currentDate = new Date();
      return {
        currentMonth: getMonth(currentDate),
        currentYear: getYear(currentDate),
        showYearDropdown: true,
        showMonthDropdown: true,
        hoveredDay: null,
      };
    },
    computed: {
      startDay() {
        const firstDayOfMonth = new Date(this.currentYear, this.currentMonth, 1);
        return firstDayOfMonth.getDay();
      },
      daysInMonth() {
        const lastDayOfMonth = new Date(this.currentYear, this.currentMonth + 1, 0);
        return Array.from({ length: lastDayOfMonth.getDate() }, (_, i) => i + 1);
      },
      years() {
        const currentYear = new Date().getFullYear();
        return Array.from({ length: 10 }, (_, i) => currentYear - 5 + i);
      },
      months() {
        return [
          'January',
          'February',
          'March',
          'April',
          'May',
          'June',
          'July',
          'August',
          'September',
          'October',
          'November',
          'December',
        ];
      },
    },
    methods: {
      isSelectedDate(day) {
        const currentDate = new Date(this.currentYear, this.currentMonth, day);
        return isSameDay(currentDate, this.modelValue);
      },
      isCurrentDate(day) {
        const today = new Date();
        return (
          today.getFullYear() === this.currentYear &&
          today.getMonth() === this.currentMonth &&
          today.getDate() === day
        );
      },
      selectDate(day) {
        this.$emit('update:modelValue', new Date(this.currentYear, this.currentMonth, day));
      },

      selectYear() {
        this.showYearDropdown = false;
      },

      selectMonth() {
        this.showMonthDropdown = false;
      },
    },
  };
  </script>

  <style scoped>
  </style>
