import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms'
import { AuthService } from '../../services/auth.service';
import { Login } from '../../actions/auth.actions';
import { currentUser } from '../../selectors/auth.selectors';
import { Store, select } from '@ngrx/store';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})

export class LoginComponent implements OnInit {

  year = new Date().getFullYear();
  form: FormGroup;
  submitted: boolean = false;
  error: string;

  constructor(
    private fb: FormBuilder,
    private service: AuthService,
    private store: Store,
    private router: Router
  ) { }

  ngOnInit() {
    this.createForm();
  }

  get f() { return this.form.controls; }

  createForm() {
    this.form = this.fb.group(
      {
        email: [null, Validators.required],
        password: [null, Validators.required]
      }
    )
  }

  onSubmit() {
    this.submitted = true;
    const controls = this.form.controls
    if (this.form.invalid) {
      return;
    }

    const values = this.prepare(controls);
    this.login(values);
  }

  prepare(controls) {
    return {
      email: controls['email'].value,
      password: controls['password'].value
    }
  }

  login(values) {
    this.service.login(values)
      .subscribe((res : any) => {
        this.store.dispatch(new Login({ token: res.token }));
        localStorage.setItem('token', res.token);
        this.router.navigate(['/sidebar']);
      }, err => {
        this.error = err.error;
      }
    )
  }
}
