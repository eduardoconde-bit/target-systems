print("Invertendo Strings")

class StringFunction:

    @staticmethod
    def reverse(chain):
        tempChain = ''
        try:
            for character in chain[::-1]:
                tempChain += character
            return tempChain

        except Exception as e:
            print(f'Error: {e}')

string = input("Entre com uma cadeia de texto: ")
print(f'Texto Invertido: {StringFunction.reverse(string)}')