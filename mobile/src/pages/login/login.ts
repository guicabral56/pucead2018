//import { LoginPage } from './login';
import { ClientePage } from './../cliente/cliente';
import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';
import { HttpClientModule } from '@angular/common/http';
import { HttpErrorResponse } from '@angular/common/http';
import { HttpClient } from '@angular/common/http';
import { AlertController } from 'ionic-angular';


@Component({
  selector: 'page-login',
  templateUrl: 'login.html'
})
export class LoginPage {

  public Login;
  public Senha;  
  //private http;

  constructor(public navCtrl: NavController, public alertCtrl : AlertController, public http: HttpClient ) {

  };

  Cadastrar(){
    this.navCtrl.push(ClientePage);
  }

  Entrar() {
    
    this.http.post('https://pucead2018.herokuapp.com/index.php/usuario/', {
      
      usuario: this.Login, senha: this.Senha, acao: 'entrar' })
      
      .subscribe( (data : any) => { 
          
          console.log(data);

          if(data.status == 1){                              

            this.navCtrl.push(ClientePage, {usuario: this.Login});

          }
          else{
            this.AlertaErro(data.mensagem);
          }

      },
        erro => { 
          this.AlertaErro(erro); 
          console.log(erro); 
      });       
    
  };

  AlertaErro(data:any){
    
    let alert = this.alertCtrl.create({
      title: 'Alerta',
      subTitle: data,
      buttons: ['OK']
    })
    alert.present();

  }


}
