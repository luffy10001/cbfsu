$(document).ready(function() {
    $("body").on('click','.toggle-password',function() {
        const elem = $(this);
        const passwordField = elem.parents(`div[toggle="password-parent"]`);
        var fieldType = passwordField.find('input').attr("type");

        if (fieldType === "password") {
            passwordField.find('input').attr("type", "text");
            $(this).removeClass("fa-eye-slash").addClass("fa-eye");
        } else {
            passwordField.find('input').attr("type", "password");
            $(this).removeClass("fa-eye").addClass("fa-eye-slash");
        }
    });
});

// Function to convert numbers into words
function convertNumberToWords(number) {
    // Array of units as words
    var units = ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];

    // Array of tens as words
    var tens = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

    // Array of scale units as words
    var scales = ['', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion', 'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion', 'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'];

    // Function to convert a three-digit group into words
    function convertThreeDigitGroup(num) {
        var currentNum = parseInt(num, 10);
        var currentWords = [];

        if (currentNum % 100 < 20) {
            currentWords.push(units[currentNum % 100]);
            currentNum = Math.floor(currentNum / 100);
        } else {
            currentWords.push(units[currentNum % 10]);
            currentNum = Math.floor(currentNum / 10);

            currentWords.push(tens[currentNum % 10]);
            currentNum = Math.floor(currentNum / 10);
        }

        if (currentNum === 0) {
            return currentWords.reverse().join(' ');
        }

        currentWords.push('hundred');
        currentWords.push(units[currentNum]);

        return currentWords.reverse().join(' ');
    }

    // Main conversion function
    function convertToWords(num) {
        if (number === '') {
            return ''; // Return empty string if the input value is empty
        }
        if (num === 0) {
            return 'zero';
        }

        var numString = num.toString();
        var numChunks = [];

        while (numString.length > 0) {
            numChunks.push(numString.slice(-3));
            numString = numString.slice(0, -3);
        }

        var words = [];
        var numChunksLength = numChunks.length;

        for (var i = numChunksLength - 1; i >= 0; i--) {
            var currentChunk = convertThreeDigitGroup(numChunks[i]);

            if (currentChunk !== '') {
                words.push(currentChunk + ' ' + scales[i]);
            }
        }

        return words.join(' ');
    }

    // Get the input value and convert it to words
    var inputValue = parseInt(number, 10);
    var words = convertToWords(inputValue);
    return words;
}

// jQuery event handler
$(document).ready(function() {
    var number = $(this).val();
    var words = convertAmountToWords(number);
    $('#result_amount').text(words);

    $('.numberInput').keyup(function() {
        var number = $(this).val();
        var words = convertAmountToWords(number);
        $('#result_amount').text(words);
    });
});

$(document).ready(function() {
    var number = $(this).val();
    var words = convertAmountToWords(number);
    $('#result_installment').text(words);
    $('.amountInput').keyup(function() {
        var number = $(this).val();
        var words = convertAmountToWords(number);
        $('#result_installment').text(words);
    });
});


var numberInputs = document.getElementsByClassName("prevent_negative");

for (var i = 0; i < numberInputs.length; i++) {
    numberInputs[i].addEventListener("keydown", function(event) {
        if (!((event.keyCode > 95 && event.keyCode < 106)
            || (event.keyCode > 47 && event.keyCode < 58)
            || event.keyCode == 8)) {
            event.preventDefault();
        }
    });
}