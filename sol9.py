from __future__ import print_function

import multiprocessing
import subprocess
import os
from time import gmtime, strftime
from datetime import datetime
def pinger( job_q, results_q ):
    DEVNULL = open(os.devnull,'w')
    while True:
        ip = job_q.get()
        if ip is None: break

        try:
            subprocess.check_call(['ping','-c1',ip],
                                  stdout=DEVNULL)
            results_q.put(ip)
        except:
            pass

if __name__ == '__main__':
    pool_size = 255

    jobs = multiprocessing.Queue()
    results = multiprocessing.Queue()

    pool = [ multiprocessing.Process(target=pinger, args=(jobs,results))
             for i in range(pool_size) ]

    for p in pool:
        p.start()
    fh = open("lab4.txt", "r")
    for i in range(1,101):
        jobs.put(fh.readline())
   
    
    for p in pool:
        jobs.put(None)

    for p in pool:
        p.join()
    output = " "
    a = str(datetime.now());
    output += a[:19]
    output +=" "
    while not results.empty():
        ip = results.get()
        ip += " "
        output +=ip
    print(output)
