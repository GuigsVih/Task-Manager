import { Component, OnInit } from '@angular/core';
import * as $ from 'jquery';
import { Store, select } from '@ngrx/store';
import { currentUser } from './selectors/auth.selectors';
import { Observable } from 'rxjs';
import { Logout } from './actions/auth.actions';
import { AuthService } from './services/auth.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit{

  user$: Observable<any>;

  constructor(
    private store: Store,
    private authService: AuthService
    ) {}

  ngOnInit() {
    this.user$ = this.store.pipe(select(currentUser));
  }

  toggle() {
    $("#wrapper").toggleClass("toggled");
  }

  dropdownToggle() {
    $('.dropdown-toggle').toggleClass('toggled');
  }
  logout() {
    this.authService.logout()
      .subscribe(res => {
          this.store.dispatch(new Logout());
        }
      )
  }
}
