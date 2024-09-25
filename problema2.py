#Fibonnaci and Sequence Numbers

a = 0
p = 1
is_sequence = False; #assumimos que é falso

number = int(input("Entre com um número: "))

while p <= number:
    if number in [a, p]:
        is_sequence = True
        break;
    print(a, end="-")
    a, p = p, p + a
    
#End Terms    
print(a, end="-")
print(p)

if is_sequence:
    print(f"número {number} faz parte da sequência de fibonnaci")
else:
    print(f"número {number} não faz parte da sequência de fibonnaci")