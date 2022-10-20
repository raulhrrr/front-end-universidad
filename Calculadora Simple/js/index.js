const handleInitProgram = () => {

    const handleMultiply = (firstNumber, secondNumber) => {
        return firstNumber * secondNumber;
    }

    const handleAdd = (firstNumber, secondNumber) => {
        return firstNumber + secondNumber;
    }

    const handleSubstract = (firstNumber, secondNumber) => {
        return firstNumber - secondNumber;
    }

    const handleSquare = (number) => {
        return number * number;
    }

    do {

        const firstNumber = Number(prompt("Ingrese el primer número"));
        const secondNumber = Number(prompt("Ingrese el segundo número"));
        const calculatorOption = Number(prompt("Que operación desea realizar?\n" +
            "1. Multiplicar\n" +
            "2. Sumar\n" +
            "3. Restar\n" +
            "4. Elevar al cuadrado\n" +
            "5. Salir\n"));

        if (isNaN(firstNumber) || isNaN(secondNumber) || isNaN(calculatorOption)) {
            alert("Alguno de los valores ingresados no es un número");
            handleInitProgram();
            return;
        }

        if (calculatorOption === 5) {
            break;
        }

        let message = "";

        switch (calculatorOption) {
            case 1:
                message = `La multiplicación entre ${firstNumber} y ${secondNumber} es: ${handleMultiply(firstNumber, secondNumber)}`;
                break;
            case 2:
                message = `La suma entre ${firstNumber} y ${secondNumber} es: ${handleAdd(firstNumber, secondNumber)}`;
                break;
            case 3:
                message = `La resta entre ${firstNumber} y ${secondNumber} es: ${handleSubstract(firstNumber, secondNumber)}`;
                break;
            case 4:
                message = `${firstNumber} elevado al cuadrado es: ${handleSquare(firstNumber)}\n`;
                message += `${secondNumber} elevado al cuadrado es: ${handleSquare(secondNumber)}`;
                break;
            default:
                alert("La opción ingresada no corresponde a las disponibles");
        }

        alert(message);

    } while (true);

}