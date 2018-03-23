import { HttpModule } from '@angular/http';
import { Component } from '@angular/core';
import { NavController, NavParams, AlertController } from 'ionic-angular';
import { HttpClientModule } from '@angular/common/http';
import { HttpErrorResponse } from '@angular/common/http';
import { HttpClient } from '@angular/common/http';


@Component({
  selector: 'cliente-page',
  templateUrl: 'cliente.html'
})
export class ClientePage {
  
    public nomecliente;
    public cpf;
    public endereco;    
    public estado;
    public municipio;
    public telefone;
    public email;
    public senha;  

    private URL_API = 'https://pucead2018.herokuapp.com/index.php/cliente';

    constructor(public Nav: NavController, public httpcli: HttpClient, public params: NavParams, public alertaCtrl : AlertController ){
      
      var usu = params.get('usuario');
      this.LoadPerfil(usu);

    };

    Alerta(data:any){    

      let alert = this.alertaCtrl.create({
        title: 'Alerta',
        subTitle: data,
        buttons: ['OK']
      })
      alert.present();
  
    }

    //salva/edita registro
    Gravar(){

      this.httpcli.post( this.URL_API + '/'+this.cpf, {
        nomecliente : this.nomecliente,
        cpf: this.cpf,
        endereco : this.endereco,
        estado: this.estado,
        municipio : this.municipio,
        telefone : this.telefone,
        email: this.email,
        senha: this.senha               
        } 
      ).subscribe( (rest : any) => {
        
          console.log(rest);
        
          this.Alerta(rest.message);
        
      }, 
        erro => {
          console.log(erro);          
        }        
      );

    };

    /** Limpa formlario para novo registro **/
    Novo(){

     this.cpf = null;
     this.email = null;
     this.endereco = null;
     this.estado = null;
     this.municipio = null;
     this.nomecliente = null;
     this.telefone = null;
     this.senha = null;     

    };

    /** Exclui Registro */
    Excluir(){

      if(confirm('Deseja realmente excluir este registro?')) {
       
        this.httpcli.delete( this.URL_API + '/'+this.cpf, {  }         
        ).subscribe( (rest : any) => {          
          
          this.Alerta(rest.message);            
          
        }, 
          erro => {
            console.log(erro);          
          }        
        );
      }     

    };

    LoadPerfil(param : string) {      
      
        this.httpcli.get( this.URL_API+'/?email='+param, {})
          .subscribe( (data : any) => {

            console.log(data[0]);
            data = data[0];
            this.nomecliente = data.nomecliente;
            this.cpf        = data.cpf;
            this.endereco   = data.endereco;
            this.estado     = data.estado;
            this.municipio  = data.municipio;
            this.telefone   = data.telefone;
            this.email      = data.email; 
          
          }, 
          error => {
            console.log(error);
        });
      
    }
}