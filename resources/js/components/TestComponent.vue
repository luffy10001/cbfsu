<template>
  <div>
    <h1>Hello Vue 3</h1>
    <select multiple>
      <option v-for="(row, i) in options" :key="i" @click="handle1($event, row)" :value="row.value">{{ row.label }}</option>
    </select>
    <select multiple>
      <option v-for="(row, i) in optionsSelected" @click="handle2($event, row)" :key="i" :value="row.value">{{ row.label }}</option>
    </select>
    <button @click="submitForm">Submit</button>
  </div>
</template>

<script>
export default {
  name: "DefaultComponent",
  data() {
    return {
      options: [
        {
          label: "Label 4",
          value: "label4",
        },
        {
          label: "Label 1",
          value: "label1",
        },
        {
          label: "Label 2",
          value: "label2",
        },
        {
          label: "Label 3",
          value: "label3",
        },
      ],
      optionsSelected: [],
    };

  },
  methods: {
    // Your existing methods

    submitForm() {
      // Get the values of both options and optionsSelected arrays
      const selectedValues = this.optionsSelected.map((item) => item.value);
      const unselectedValues = this.options.map((item) => item.value);

      // Log or use the values as needed
      console.log("Selected Values:", selectedValues);
      console.log("Unselected Values:", unselectedValues);
    }
  }
};
</script>


<!--<script>-->
<!--export default {-->
<!--  name: "DefaultComponent",-->
<!--  data() {-->
<!--    return {-->
<!--      options: [-->
<!--        {-->
<!--          label: "Label 4",-->
<!--          value: "label4",-->
<!--        },-->
<!--        {-->
<!--          label: "Label 1",-->
<!--          value: "label1",-->
<!--        },-->
<!--        {-->
<!--          label: "Label 2",-->
<!--          value: "label2",-->
<!--        },-->
<!--        {-->
<!--          label: "Label 3",-->
<!--          value: "label3",-->
<!--        },-->
<!--      ],-->
<!--      optionsSelected: [],-->
<!--    };-->
<!--  },-->
<!--  methods: {-->
<!--    handle1(e, row) {-->
<!--      // Your existing code for handling selection-->
<!--    },-->
<!--    handle2(e, row) {-->
<!--      // Your existing code for handling deselection-->
<!--    },-->
<!--    logOptionsSelected() {-->
<!--      console.log(this.optionsSelected);-->
<!--    },-->
<!--    searchOption(options, value) {-->
<!--      // Your existing code for searching options-->
<!--    },-->
<!--  },-->
<!--};-->
<!--</script>-->
