using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace bibliothequePapillon
{
    public class Oeuf : StadeDEvolution
    {
        public Oeuf()
        {
            
        }
        public override void SeDeplacer()
        {
            Console.WriteLine("Je peux pas");
        }
        public override StadeDEvolution SeMetamorphoser()
        {

            return new Chenille();
        }
    }
}
