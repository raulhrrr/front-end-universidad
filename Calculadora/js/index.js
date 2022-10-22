const operators = ["/", "*", "-", "+"];

const handleAddOperator = (operator) => {
    const inputValue = document.getElementById("answer").value;
    const inputValueWithoutLastCharacter = inputValue.substr(0, inputValue.length - 1);
    const lastCharacter = inputValue.charAt(inputValue.length - 1);

    console.log(inputValue);
    console.log(inputValueWithoutLastCharacter)
    console.log(lastCharacter)

    if (lastCharacter === operator) {
        return;
    }
    
    if (operators.includes(lastCharacter) && operators.includes(operator)) {
        document.calculator.answer.value = inputValueWithoutLastCharacter + operator;
        return;
    }

    document.calculator.answer.value += operator;
}