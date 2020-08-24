import { Injectable } from '@angular/core';
import { formatDate } from '@angular/common';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

export interface CurrencyRate {
  id: number;
  currency: string;
  rate: number;
  recordDate: any;
}

@Injectable()
export class CurrencyRateService {
  constructor(public http: HttpClient) { }

  public get apiUrl(): string { return `http://localhost:8000`; }

  getAllData(): Observable<CurrencyRate[]> {
    return this.http.get<CurrencyRate[]>(this.apiUrl + '/currencyRates');
  }

  getByCurrencyName(currencyName: string): Observable<CurrencyRate[]> {
    return this.http.get<CurrencyRate[]>(this.apiUrl + '/currencyRatesByName', {
      params: {
        currency: currencyName
      }
    });
  }

  // payForPrint(amount: number, paymentType: string = 'PrintBalance'): Observable<CurrencyRate> {
  //   const url = `${this.apiUrl}/pay`;
  //   return this.http.post(url, {
  //     Amount: amount,
  //     PaymentType: paymentType
  //   }).pipe(map(res => res.json()));
  // }
}
