import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CurrencyRatesListComponent } from './currency-rates-list.component';

describe('CurrencyRatesListComponent', () => {
  let component: CurrencyRatesListComponent;
  let fixture: ComponentFixture<CurrencyRatesListComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CurrencyRatesListComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CurrencyRatesListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
