import { Component, OnInit, ViewChild } from '@angular/core';
import { CurrencyRate, CurrencyRateService } from '../currency-rates.service';
import { formatDate } from '@angular/common';
import { MatPaginator } from '@angular/material/paginator';
import { MatTableDataSource } from '@angular/material/table';

@Component({
  selector: 'app-currency-rates-list',
  templateUrl: './currency-rates-list.component.html',
  styleUrls: ['./currency-rates-list.component.css']
})

export class CurrencyRatesListComponent implements OnInit {
  currencyRates: CurrencyRate[];
  errorMessage: string;
  isLoading = true;
  selectedCurrency = false;
  dataSource = new MatTableDataSource<CurrencyRate>(this.currencyRates);

  @ViewChild(MatPaginator, {static: true}) paginator: MatPaginator;

  constructor(private currencyRateService: CurrencyRateService) { }

  ngOnInit(): void {
    console.log('ngOnInit');
    this.getCurrencyRates();
  }

  getCurrencyRates(): void {
    this.selectedCurrency = false;
    this.isLoading = true;
    this.currencyRateService.getAllData()
        .subscribe(data => {
          if (data) {
            data.forEach(value => {
              value.recordDate = formatDate(value.recordDate.date, 'yyyy/MM/dd', 'en');
            });
            this.currencyRates = data;
            this.dataSource = new MatTableDataSource<CurrencyRate>(this.currencyRates);
            this.dataSource.paginator = this.paginator;
            // console.log(data);
            this.isLoading = false;
          }
        }, error => this.errorMessage = error);
  }

  getCurrencyRate(currencyName: string): void {
    this.selectedCurrency = true;
    this.isLoading = true;
    this.currencyRateService.getByCurrencyName(currencyName)
        .subscribe(data => {
          if (data) {
            data.forEach(value => {
              value.recordDate = formatDate(value.recordDate.date, 'yyyy/MM/dd', 'en');
            });
            this.currencyRates = data;
            this.dataSource = new MatTableDataSource<CurrencyRate>(this.currencyRates);
            this.dataSource.paginator = this.paginator;
            // console.log(data);
            this.isLoading = false;
          }
        }, error => console.log(error));
  }
}
