#possible Invoicing Class in OOP
import json
import locale

locale.setlocale(locale.LC_ALL, 'pt_BR.UTF-8')

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
    print(f"Média Mensal: \033[32m{locale.currency(average_profit, grouping=True)} \033[m")
    print(f"Número de Dias (Lucro Maior) sobre Média Mensal: \033[32m{d_a_average_revenue} \033[m")
    print(f"O menor valor do faturamento no mês (dia útil): \033[32m{locale.currency(min_profit_day, grouping=True)} \033[m")
    print(f"O maior valor do faturamento no mês (dia útil): \033[32m{locale.currency(max_profit_day, grouping=True)} \033[m")
    print("-"*60)
except Exception as e:
    #Exceção qualquer
    print(f"Ocorreu um erro:\n {e}")