def saldo(valor):
	global SALDO
	SALDO = valor

def pegarSaldo():
	global SALDO
	return SALDO

def ouvirCliente(conn, addr):

	SALDO = pegarSaldo()

	while 1:
		try:
			data = conn.recv(1024).decode("utf-8")
			if data:
				op, valor = data.split(' ')
				if op != None and valor != None:
					if op == 'saldo':
						print("[SERVIDOR] consultar saldo.")
						response = str(SALDO)

					elif op == 'deposito':
						print("[SERVIDOR] depositar.")
						SALDO = int(SALDO) + int(valor)
						saldo(SALDO)
						response = str("%d %d" % (int(SALDO), int(SALDO) - int(valor)))

					elif op == 'sacar':
						print("[SERVIDOR] sacar.")
						if int(valor) <= SALDO:
							SALDO = int(SALDO) - int(valor)
							saldo(SALDO)
							response = str("%d %d" % (int(SALDO), int(SALDO) + int(valor)))
						else:
							response = '1'

					else:
						response = '0'
					conn.send(response.encode())

		except:
		    conn.close()
		    return False