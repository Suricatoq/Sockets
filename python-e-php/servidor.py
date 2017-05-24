#!/usr/bin/env python
# -*- coding: utf-8 -*-

import sys
import socket
import threading
import func

TCP_IP = '127.0.0.1'
TCP_PORT = 6006
func.saldo(5000)

s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
s.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
s.bind((TCP_IP, TCP_PORT))
s.listen(10)	

print ("[SERVIDOR] Abrindo a porta " + str(TCP_PORT) + " e ouvindo")

while 1:

	conn, addr = s.accept()
	conn.settimeout(60)
	threading.Thread(target = func.ouvirCliente, args = (conn, addr)).start()
