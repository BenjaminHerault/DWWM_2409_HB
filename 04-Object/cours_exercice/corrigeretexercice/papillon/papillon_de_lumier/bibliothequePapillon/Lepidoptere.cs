﻿using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace bibliothequePapillon
{
    public class Lepidoptere
    {

        private string espece;
        private StadeDEvolution sonStadeCourant;

        public Lepidoptere(string espece)
        {
            this.espece = espece;
            this.sonStadeCourant = new Oeuf();
        }
        public void SeDeplacer()
        {
            this.sonStadeCourant.SeDeplacer();
        }
        public void SeMetamorphoser()
        {
            this.sonStadeCourant = this.sonStadeCourant.SeMetamorphoser();
        }
    }
}
