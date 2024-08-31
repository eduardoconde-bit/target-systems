#Simulando Json
data_invoicing = {"SP":67836.43, "RJ": 36678.66,"MG": 29229.88,"ES": 27165.48, "OUTROS": 19849.53}

#value vision in data dict
total_monthy = sum(data_invoicing.values())

print("-"*70)
print("percentual de representação que cada estado teve dentro do valor total mensal da distribuidora")
print("-"*70)

#calc
for invoicing in data_invoicing:
    
    valueInv = data_invoicing[invoicing]
    valueInv = valueInv / total_monthy * 100
    
    print(f'Estado - {invoicing}: {valueInv:.2f}%')
    #print(f'Estado - {invoicing}: {(valueInv / total_monthy * 100):.2f}%')

print("-"*70)
