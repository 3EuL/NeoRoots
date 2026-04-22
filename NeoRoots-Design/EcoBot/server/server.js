import express from "express";
import cors from "cors";
import dotenv from "dotenv";
import OpenAI from "openai";

dotenv.config();

const app = express();
app.use(cors());
app.use(express.json());

const openai = new OpenAI({
  apiKey: process.env.OPENAI_API_KEY
});

const SYSTEM_PROMPT = `
Eres un asistente de atención al cliente para una empresa de recolección de residuos.

Funciones:
- Explicar horarios de recolección
- Clasificar residuos (orgánicos, reciclables, peligrosos)
- Dar consejos de reciclaje
- Resolver dudas de usuarios

Responde claro, breve y útil.
`;

app.post("/chat", async (req, res) => {
  try {
    const { mensaje } = req.body;

    const response = await openai.chat.completions.create({
      model: "gpt-4.1-mini",
      messages: [
        { role: "system", content: SYSTEM_PROMPT },
        { role: "user", content: mensaje }
      ]
    });

    res.json({
      respuesta: response.choices[0].message.content
    });

  } catch (error) {
    console.error(error);
    res.status(500).json({ error: "Error en el servidor" });
  }
});

app.listen(3000, () => {
  console.log("Servidor corriendo en http://localhost:3000");
});