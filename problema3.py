#possible Invoicing Class in OOP
import json

invoicing_list = []
#Days Above Average Revenue 
d_a_average_revenue = 0

#Open json file, read and process data
try:
    with open('invoicing.json', mode='r') as invoicing_json:
        invoicing_data = json.load(invoicing_json)
        for invoicing in invoicing_data:
            if invoicing["valor"] > 0: #!=, or >
                invoicing_list.append(invoicing["valor"])
except Exception as e:
    #Exceção qualquer
    print(f"Ocorreu um erro {e}")

#Monthly Average and calculation of Days Above Average Revenue
average_profit = (sum(invoicing_list)) / len(invoicing_list)

for invoice in invoicing_list:
    if invoice > average_profit:
        d_a_average_revenue += 1

min_profit_day = min(invoicing_list)
max_profit_day = max(invoicing_list) 

#Result output, considering working days.
print("-"*20 + " DISTRIBUIDORA LTDA " + "-"*20)
print("-"*60)
print(f"Média Mensal: R$ {average_profit:,.2f}")
print(f"Número de Dias (Lucro Maior) sobre Média Mensal: {d_a_average_revenue}")
print(f"O menor valor do faturamento no mês (dia útil): R$ {min_profit_day:,.2f}")
print(f"O maior valor do faturamento no mês (dia útil): R$ {max_profit_day:,.2f}")
print("-"*60)